<?php

class Zookal_Mock_Model_Observer
{
    /**
     * @var array
     */
    protected $_disabledModules = null;

    public function mockDisabledModules(Varien_Event_Observer $observer)
    {
        $modules = $this->_getDisabledModules();
        foreach ($modules as $moduleName) {
            $class = 'Zookal_Mock_Model_Mocks_' . $moduleName;
            if (true === class_exists($class)) {
                Mage::getConfig()->setNode('global/models/' . ($class::getConfigModelName()), $class);
            }
        }
    }

    /**
     * @return array
     */
    protected function _getDisabledModules()
    {
        if (null !== $this->_disabledModules) {
            return $this->_disabledModules;
        }

        $modules = Mage::getConfig()->getNode('modules');
        foreach ($modules->children() as $moduleName => $node) {
            /** @var $node Mage_Core_Model_Config_Element */
            $isDisabled = strtolower($node->active) !== 'true';
            if (true === $isDisabled) {
                $this->_disabledModules[$moduleName] = $moduleName;
            }
        }
        return $this->_disabledModules;
    }
}