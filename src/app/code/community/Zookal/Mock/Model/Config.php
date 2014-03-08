<?php
/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Model_Config extends Mage_Core_Model_Config
{
    /**
     * Key = active Module name => values inactive Module names whose dependency can be removed
     * @var array
     */
    protected $_dependencyLiars = array(
        'Mage_Log'      => array('Mage_Customer'),
        'Mage_Tax'      => array('Mage_Customer'),
        'Mage_Catalog'  => array('Mage_Dataflow'),
        'Mage_Customer' => array('Mage_Dataflow'),
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
        $disabledModules = $this->_getDisabledModules($modules);

        foreach ($modules as $moduleName => &$config) {
            if (FALSE === isset($this->_dependencyLiars[$moduleName]) || FALSE === $config['active']) {
                continue;
            }

            foreach ($this->_dependencyLiars[$moduleName] as $inactiveModule) {
                if (TRUE === isset($disabledModules[$inactiveModule])) { // check if it's really disabled
                    unset($config['depends'][$inactiveModule]); // remove dependency
                }
            }
        }
        return parent::_sortModuleDepends($modules);
    }

    /**
     * @param array $modules
     *
     * @return array
     */
    protected function _getDisabledModules(array $modules)
    {
        $_disabledModules = array();
        foreach ($modules as $moduleName => $node) {
            $isDisabled = $node['active'] !== TRUE;
            if (TRUE === $isDisabled) {
                $_disabledModules[$moduleName] = $moduleName;
            }
        }
        return $_disabledModules;
    }
}
