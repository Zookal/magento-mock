<?php

/**
 * @category    Zookal_Mock
 * @package     Helper
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Model_Observer
{
    /**
     * Only add these modules which are tightly coupled with the core and causes issues once active=>false
     * Module Name => model name
     *
     * @var array
     */
    protected $_mappingModel = array(
        'Mage_Wishlist'   => 'wishlist',
        'Mage_Tag'        => 'tag',
        'Mage_Tax'        => 'tax',
        'Mage_Sales'      => 'sales',
        'Mage_Review'     => 'review',
        'Mage_Reports'     => 'reports',
        'Mage_Rating'     => 'rating',
        'Mage_Newsletter' => 'newsletter',
        'Mage_Log'        => 'log',
        'Mage_Catalog'    => 'catalog',
        'Mage_Backup'     => 'backup',
    );

    /**
     * @param Varien_Event_Observer $observer
     */
    public function mockDisabledModules(Varien_Event_Observer $observer)
    {
        $modules = $this->_getDisabledModules();
        $pathPrefix = 'global/models/';

        foreach ($modules as $moduleName => $module) {
            if (TRUE === isset($this->_mappingModel[$moduleName])) {
                $class = 'Zookal_Mock_Model_Mocks_' . $module[0];
                Mage::getConfig()->setNode($pathPrefix . $this->_mappingModel[$moduleName] . '/class', $class);
                $resource = $this->_mappingModel[$moduleName] . '_resource';
                Mage::getConfig()->setNode($pathPrefix . $this->_mappingModel[$moduleName] . '/resourceModel', $resource);
                Mage::getConfig()->setNode($pathPrefix . $resource . '/class', $class);

                /**
                 * Special case when Mage_Tax is disabled and Mage_Customer is enabled
                 * Mage_Customer needs the tax_class table name for joining
                 */
                if ('Mage_Tax' === $moduleName) {
                    Mage::getConfig()->setNode($pathPrefix . $resource . '/entities/tax_class/table', 'tax_class');
                }
            }
        }
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
}