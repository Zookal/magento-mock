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
        'Mage_Wishlist'          => 'wishlist',
        'Mage_Weee'              => 'weee',
        'Mage_Usa'               => 'usa',
        'Mage_Tag'               => 'tag',
        'Mage_Tax'               => 'tax',
        'Mage_Shipping'          => 'shipping',
        'Mage_Sales'             => 'sales',
        'Mage_Review'            => 'review',
        'Mage_Reports'           => 'reports',
        'Mage_Rating'            => 'rating',
        'Mage_ProductAlert'      => 'productalert',
        'Mage_Newsletter'        => 'newsletter',
        'Mage_Log'               => 'log',
        'Mage_GoogleCheckout'    => 'googlecheckout',
        'Mage_GiftMessage'       => 'giftmessage',
        'Mage_Dataflow'          => 'dataflow',
        'Mage_Catalog'           => 'catalog',
        'Mage_Customer'          => 'customer',
        'Mage_Cms'               => 'cms',
        'Mage_Backup'            => 'backup',
        'Mage_Adminhtml'         => 'adminhtml',
        'Mage_Admin'             => 'admin',
        'Mage_AdminNotification' => 'adminnotification',
    );

    /**
     * These methods will only be executed when that module has been disabled.
     *
     * @var array
     */
    protected $_specialMethods = array(
        'Mage_Admin'             => '_mageMockIncludePath',
        'Mage_Adminhtml'         => '_mageMockIncludePath',
        'Mage_AdminNotification' => '_mageMockIncludePath',
        'Mage_Catalog'           => '_mageCatalog',
        'Mage_Customer'          => '_mageCustomer',
        'Mage_GiftMessage'       => '_mageMockHelperIncludePath',
        'Mage_GoogleCheckout'    => '_mageGoogleCheckout',
        'Mage_Log'               => '_mageMockIncludePath',
        'Mage_ProductAlert'      => '_mageMockHelper',
        'Mage_Review'            => '_mageMockHelper',
        'Mage_Shipping'          => '_mageMockHelperIncludePath',
        'Mage_Tag'               => '_mageMockHelperIncludePath',
        'Mage_Tax'               => '_mageTaxClass',
        'Mage_Usa'               => '_mageMockHelper',
        'Mage_Wishlist'          => '_mageMockHelper',
        'Mage_Weee'              => '_mageMockIncludePath',
    );

    /**
     * only needed for the crontab because implemented on the two events always and default.
     * For controller execution we're only observing controller_front_init_before which fires once
     *
     * @var int
     */
    private $_singleton = 0;

    /**
     * To use this in a shell script (no cron) call it: Mage::getModel('zookal_mock/observer')->mockDisabledModules();
     * @fire always
     * @fire default
     * @fire controller_front_init_before
     * @return null
     */
    public function mockDisabledModules()
    {
        if ($this->_singleton > 0) {
            return;
        }
        $this->_singleton++;

        $disabledModules = $this->_getDisabledModules();
        $pathPrefix      = 'global/models/';

        foreach ($disabledModules as $moduleName => $module) {
            if (false === isset($this->_mappingModel[$moduleName])) {
                continue;
            }
            $class = 'Zookal_Mock_Model_Mocks_' . $module[0];
            $this->_setConfigNode($pathPrefix . $this->_mappingModel[$moduleName] . '/class', $class);
            $resource = $this->_mappingModel[$moduleName] . '_resource';
            $this->_setConfigNode($pathPrefix . $this->_mappingModel[$moduleName] . '/resourceModel', $resource);
            $this->_setConfigNode($pathPrefix . $resource . '/class', $class);
            $this->{$this->_getSpecialMethod($moduleName)}(array(
                'p' => $pathPrefix,
                'm' => $moduleName,
                'r' => $resource
            ));
        }
        $this->_processSetNodes();
        return;
    }

    /**
     * Runs a specialMethod if its found otherwise _mageVoid will be executed
     *
     * @param $moduleName
     *
     * @return string
     */
    protected function _getSpecialMethod($moduleName)
    {
        return isset($this->_specialMethods[$moduleName]) ? $this->_specialMethods[$moduleName] : '_mageVoid';
    }

    /**
     * Special Handling when Mage_Adminhtml/Mage_Log/Mage_Tag is disabled and physically removed
     */
    protected function _mageMockIncludePath()
    {
        Mage::helper('zookal_mock')->setMockPhpIncludePath();
    }

    /**
     * Special Handling when Mage_GoogleCheckout is disabled. It has a dependency in Mage_Sales/etc/config.xml :-(
     *
     * @param array $o
     */
    protected function _mageGoogleCheckout(array $o)
    {
        // recent versions of Mage_Sales do not depend on Mage_GoolgeCheckout
        if (method_exists('Mage', 'getEdition')){ // available from CE 1.7
            if ((version_compare(Mage::getVersion(), '1.9.0.0', '>=') && (Mage::getEdition() == Mage::EDITION_COMMUNITY)) 
                || (version_compare(Mage::getVersion(), '1.14.0.0', '>=') && (Mage::getEdition() == Mage::EDITION_ENTERPRISE))){
                return;
            }
        }

        $prefixes = $this->_getAllPathPrefixes();
        foreach ($prefixes as $prefix) {
            $this->_setConfigNode($prefix . '/payment/' . $this->_mappingModel[$o['m']] . '/active', '0');
            $this->_setConfigNode(
                $prefix . '/payment/' . $this->_mappingModel[$o['m']] . '/model',
                'zookal_mock/mocks_mage_payment'
            );
        }
    }

    /**
     * Special Handling when Mage_ProductAlert is disabled, when need to fake a helper
     *
     * @param array $o
     */
    protected function _mageMockHelper(array $o)
    {
        $this->_setConfigNode('global/helpers/' . $this->_mappingModel[$o['m']] . '/class', 'zookal_mock/mocks_mage');
    }

    /**
     * Special Handling when Mage_ProductAlert is disabled, when need to fake a helper
     *
     * @param array $o
     */
    protected function _mageMockHelperIncludePath(array $o)
    {
        $this->_mageMockHelper($o);
        $this->_mageMockIncludePath();
    }

    /**
     * Special case when Mage_Catalog is disabled and Mage_Widget is enabled
     */
    protected function _mageCatalog()
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
     * @param array $o
     */
    protected function _mageCustomer(array $o)
    {
        $this->_setConfigNode($o['p'] . $o['r'] . '/entities/customer_group/table', 'customer_group');
    }

    /**
     * Special case when Mage_Tax is disabled and Mage_Customer is enabled
     * Mage_Customer needs the tax_class table name for joining
     *
     * @param array $o
     */
    protected function _mageTaxClass(array $o)
    {
        $this->_setConfigNode($o['p'] . $o['r'] . '/entities/tax_class/table', 'tax_class');
    }

    /**
     * empty method for fallback
     */
    protected function _mageVoid()
    {
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
            if (true === $isDisabled) {
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
}
