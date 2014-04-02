<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Model_Mocks_Mage_Payment extends Zookal_Mock_Model_Mocks_Abstract
{
    /**
     * @var Mage_Core_Model_Store
     */
    protected $_store = null;

    public function __construct($helper = null, $store = null)
    {
        parent::__construct($helper);
        if (false === empty($store) && $store instanceof Mage_Core_Model_Store) {
            $this->_store = $store;
        }
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
     * @see Mage_Payment_Helper_Data
     * Retrieve block type for display method information
     * Only frontend layout generation checks if a block is an instance of Mage_Core_Block_Abstract therefore we need to separate.
     *
     * @return string
     */
    public function getInfoBlockType()
    {
        return 'zookal_mock/payment_' . ($this->_isAdmin() ? 'backend' : 'frontend');
    }

    /**
     * @see Mage_Payment_Helper_Data
     *
     * Retreive payment method form html
     *
     * @return  Zookal_Mock_Block_Payment_Backend
     */
    public function getMethodFormBlock()
    {
        return new Zookal_Mock_Block_Payment_Backend();
    }

    /**
     * @see http://stackoverflow.com/questions/9693020/magento-request-frontend-or-backend thanks alan :-)
     * @return bool
     */
    protected function _isAdmin()
    {
        return ($this->getStore()->isAdmin() || Mage::getDesign()->getArea() === 'adminhtml');
    }
}