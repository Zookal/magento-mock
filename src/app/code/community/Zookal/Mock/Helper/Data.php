<?php

/**
 * @category    Zookal_Mock
 * @package     Helper
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     * @var Mage_Core_Model_Store
     */
    protected $_store = null;

    /**
     * @param Mage_Core_Model_Store $store
     */
    public function __construct(Mage_Core_Model_Store $store = null)
    {
        $this->_store = $store;
    }

    /**
     * @return Mage_Core_Model_Store
     */
    public function getStore()
    {
        if (null === $this->_store) {
            $this->_store = Mage::app()->getStore();
        }
        return $this->_store;
    }

    /**
     * @return boolean
     */
    public function isLogMethodEnabled()
    {
        return (int)$this->getStore()->getConfig('system/zookalmock/enable_method_log') === 1;
    }
}