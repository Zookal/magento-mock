<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Model_Observer
{
    /**
     * General Container for rewriting nodes entries
     *
     * @var array
     */
    protected $_newConfigNodes = array();

    /**
     * Only add these modules which are tightly coupled with the core and causes issues once active=>false
     * Module Name => model name
     *
     * @var array
     */
    protected $_mappingModel = array(
        'Mage_Wishlist'       => 'wishlist',
        'Mage_Tag'            => 'tag',
        'Mage_Tax'            => 'tax',
        'Mage_Sales'          => 'sales',
        'Mage_Review'         => 'review',
        'Mage_Reports'        => 'reports',
        'Mage_Rating'         => 'rating',
        'Mage_ProductAlert'   => 'productalert',
        'Mage_Newsletter'     => 'newsletter',
        'Mage_Log'            => 'log',
        'Mage_GoogleCheckout' => 'googlecheckout',
        'Mage_Dataflow'       => 'dataflow',
        'Mage_Catalog'        => 'catalog',
        'Mage_Customer'       => 'customer',
        'Mage_Cms'            => 'cms',
        'Mage_Backup'         => 'backup',
        'Mage_Adminhtml'      => 'adminhtml',
    );

    private $_includePathSet = NULL;

    /**
     * @param Varien_Event_Observer $observer
     */
    public function mockDisabledModules(Varien_Event_Observer $observer)
    {
        $disabledModules = $this->_getDisabledModules();
        $pathPrefix      = 'global/models/';

        $specialMethods = array(
            'Mage_Adminhtml'      => '_mageAdminhtml',
            'Mage_Catalog'        => '_mageCatalog',
            'Mage_Customer'       => '_mageCustomer',
            'Mage_GoogleCheckout' => '_mageGoogleCheckout',
            'Mage_ProductAlert'   => '_mageMockHelper',
            'Mage_Review'         => '_mageMockHelper',
            'Mage_Tax'            => '_mageTaxClass',
            'Mage_Wishlist'       => '_mageMockHelper',
        );

        foreach ($disabledModules as $moduleName => $module) {
            if (FALSE === isset($this->_mappingModel[$moduleName])) {
                continue;
            }
            $class = 'Zookal_Mock_Model_Mocks_' . $module[0];
            $this->_setConfigNode($pathPrefix . $this->_mappingModel[$moduleName] . '/class', $class);
            $resource = $this->_mappingModel[$moduleName] . '_resource';
            $this->_setConfigNode($pathPrefix . $this->_mappingModel[$moduleName] . '/resourceModel', $resource);
            $this->_setConfigNode($pathPrefix . $resource . '/class', $class);

            if (TRUE === isset($specialMethods[$moduleName])) {
                $this->{$specialMethods[$moduleName]}($pathPrefix, $moduleName, $resource);
            }
        }
        $this->_processSetNodes();
    }

    /**
     * Special Handling when Adminhtml is disabled and physically removed
     *
     * @param $pathPrefix
     * @param $moduleName
     * @param $resource
     */
    protected function _mageAdminhtml($pathPrefix, $moduleName, $resource)
    {
        $this->_setMockIncludePath();
    }

    /**
     * Special Handling when Mage_GoogleCheckout is disabled. It has a dependency in Mage_Sales/etc/config.xml :-(
     *
     * @param $pathPrefix
     * @param $moduleName
     * @param $resource
     */
    protected function _mageGoogleCheckout($pathPrefix, $moduleName, $resource)
    {
        $prefixes = $this->_getAllPathPrefixes();
        foreach ($prefixes as $prefix) {
            $this->_setConfigNode($prefix . '/payment/' . $this->_mappingModel[$moduleName] . '/active', '0');
            $this->_setConfigNode($prefix . '/payment/' . $this->_mappingModel[$moduleName] . '/model', 'zookal_mock/mocks_mage_payment');
        }
    }

    /**
     * Special Handling when Mage_ProductAlert is disabled, when need to fake a helper
     *
     * @param $pathPrefix
     * @param $moduleName
     * @param $resource
     */
    protected function _mageMockHelper($pathPrefix, $moduleName, $resource)
    {
        $this->_setConfigNode('global/helpers/' . $this->_mappingModel[$moduleName] . '/class', 'zookal_mock/mocks_mage');
    }

    /**
     * Special case when Mage_Catalog is disabled and Mage_Widget is enabled
     *
     * @param $pathPrefix
     * @param $moduleName
     * @param $resource
     */
    protected function _mageCatalog($pathPrefix, $moduleName, $resource)
    {
        $prefix = 'global/catalog/product/type/simple/';
        $this->_setConfigNode($prefix . 'label', 'Simple Product');
        $this->_setConfigNode($prefix . 'model', 'zookal_mock/mocks_mage_product');
        $this->_setConfigNode($prefix . 'composite', '0');
        $this->_setConfigNode($prefix . 'index_priority', '10');
    }

    /**
     * Special case when Mage_CatalogIndex is enabled and Mage_Customer is disabled
     * Mage_Customer needs the tax_class table name for joining
     *
     * @param $pathPrefix
     * @param $moduleName
     * @param $resource
     */
    protected function _mageCustomer($pathPrefix, $moduleName, $resource)
    {
        $this->_setConfigNode($pathPrefix . $resource . '/entities/customer_group/table', 'customer_group');
    }

    /**
     * Special case when Mage_Tax is disabled and Mage_Customer is enabled
     * Mage_Customer needs the tax_class table name for joining
     *
     * @param $pathPrefix
     * @param $moduleName
     * @param $resource
     */
    protected function _mageTaxClass($pathPrefix, $moduleName, $resource)
    {
        $this->_setConfigNode($pathPrefix . $resource . '/entities/tax_class/table', 'tax_class');
    }

    /**
     * @return array
     */
    protected function _getDisabledModules()
    {
        $_disabledModules = array();

        $modules = Mage::getConfig()->getNode('modules');
        foreach ($modules->children() as $moduleName => $node) {
            /** @var $node Mage_Core_Model_Config_Element */
            $isDisabled = strtolower($node->active) !== 'true';
            if (TRUE === $isDisabled) {
                $_disabledModules[$moduleName] = explode('_', $moduleName);
            }
        }
        return $_disabledModules;
    }

    /**
     * @param string $path
     * @param string $value
     */
    protected function _setConfigNode($path, $value)
    {
        $this->_newConfigNodes[$path] = $value;
    }

    /**
     * runs setNode on getConfig
     */
    protected function _processSetNodes()
    {
        foreach ($this->_newConfigNodes as $path => $value) {
            Mage::getConfig()->setNode($path, $value);
        }
    }

    /**
     * refactor when used more than once
     *
     * @return array
     */
    protected function _getAllPathPrefixes()
    {
        $prefixes = array(
            'default'      => 'default',
            'stores/admin' => 'stores/admin',
        );

        $stores = Mage::app()->getStores();
        foreach ($stores as $store) {
            /** @var $store Mage_Core_Model_Store */
            $prefixes['stores/' . $store->getCode()] = 'stores/' . $store->getCode();
        }
        return $prefixes;
    }

    /**
     * @param array $adminHtmlFakePath
     *
     * @return bool
     */
    protected function _setMockIncludePath(array $adminHtmlFakePath = NULL)
    {
        if (NULL === $this->_includePathSet) {
            $adminHtmlFakePath     = NULL === $adminHtmlFakePath
                ? array(
                    'app', 'code', 'community', 'Zookal', 'Mock', 'Model', 'Mocks'
                )
                : $adminHtmlFakePath;
            $includePath           = BP . DS . implode(DS, $adminHtmlFakePath) . PS . get_include_path();
            $this->_includePathSet = set_include_path($includePath);
        }

        return $this->_includePathSet !== FALSE;
    }
}