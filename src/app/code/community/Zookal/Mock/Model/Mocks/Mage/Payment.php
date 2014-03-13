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
        return (Mage::app()->getStore()->isAdmin() || Mage::getDesign()->getArea() === 'adminhtml');
    }
}