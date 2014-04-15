<?php
/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */

/**
 * Only usable in index.php:
 * Mage::run($mageRunCode, $mageRunType, array(
 * 'config_model' => 'Zookal_Mock_Model_Config'
 * ));
 *
 * Class Zookal_Mock_Model_Config
 */
class Zookal_Mock_Model_Config extends Mage_Core_Model_Config
{
    /**
     * Key = active Module name => values inactive Module names whose dependency can be removed.
     * If you find more please send me a PR.
     * Maybe this config could also reside in a xml file.
     * @var array
     */
    protected $_dependencyLiars = array(
        'Mage_Reports'       => array('Mage_Sales', 'Mage_Customer'),
        'Mage_Log'           => array('Mage_Customer'),
        'Mage_Tax'           => array('Mage_Customer'),
        'Mage_Poll'          => array('Mage_Cms'),
        'Mage_Newsletter'    => array('Mage_Widget'),
        'Mage_Catalog'       => array('Mage_Dataflow', 'Mage_Cms'),
        'Mage_CatalogRule'   => array('Mage_Customer'),
        'Mage_CatalogIndex'  => array('Mage_CatalogRule'),
        'Mage_Checkout'      => array('Mage_CatalogInventory'),
        'Mage_Customer'      => array('Mage_Dataflow'),
        'Mage_Persistent'    => array('Mage_Adminhtml'),
        'Mage_Captcha'       => array('Mage_Adminhtml'),
        'VinaiKopp_LoginLog' => array('Mage_Adminhtml'),
    );

    /**
     * Removes the dependencies for some modules configured in $_dependencyLiars
     * e.g. if Mage_Log is active and Mage_Customer is disabled then remove Mage_Customer dependency
     *
     * @param array $modules
     *
     * @return array
     */
    protected function _sortModuleDepends($modules)
    {
        $modules = $this->removeDependencies($modules);
        return parent::_sortModuleDepends($modules);
    }

    /**
     * @param array $modules
     *
     * @return array
     */
    public function removeDependencies(array $modules)
    {
        $disabledModules = $this->getDisabledModules($modules);
        foreach ($modules as $moduleName => $config) {
            if (false === isset($this->_dependencyLiars[$moduleName]) || false === $config['active']) {
                continue;
            }
            foreach ($this->_dependencyLiars[$moduleName] as $inactiveModule) {
                if (true === isset($disabledModules[$inactiveModule])) { // check if it's really disabled
                    unset($modules[$moduleName]['depends'][$inactiveModule]); // remove dependency
                }
            }
        }
        return $modules;
    }

    /**
     * @param array $modules
     *
     * @return array
     */
    public function getDisabledModules(array $modules)
    {
        $_disabledModules = array();
        foreach ($modules as $moduleName => $node) {
            $isDisabled = $node['active'] !== true;
            if (true === $isDisabled) {
                $_disabledModules[$moduleName] = $moduleName;
            }
        }
        return $_disabledModules;
    }

    /**
     * @return array
     */
    public function getDependencyLiars()
    {
        return $this->_dependencyLiars;
    }
}
