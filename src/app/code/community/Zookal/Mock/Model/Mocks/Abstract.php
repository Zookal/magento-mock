<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
abstract class Zookal_Mock_Model_Mocks_Abstract
{

    /**
     * @var Zookal_Mock_Helper_Data
     */
    protected $_helper = null;

    protected $_isLogEnabled = false;

    protected $_mockMethodsReturnThis = array(
        'add'            => 1, // e.g. addCustomerFilter ...
        'cle'            => 1, // e.g. clean() clear() clearasil()
        'gettotals'      => 1, // Special case in Sales_Collection
        'gro'            => 1, // e.g. groupByCustomer
        'joi'            => 1, // e.g. joinCustomerName
        'loa'            => 1, // e.g. load and loadBy....
        'lim'            => 1, // e.g. limit() -> on collection
        'ord'            => 1, // e.g. orderByTotalAmount
        'pre'            => 1, // e.g. prepare()
        'resetsortorder' => 1,
        'renewsession'   => 1,
        'set'            => 1,
        'too'            => 1, // e.g. toOptionArray, toOptionHash
        'uns'            => 1,
    );
    protected $_mockMethodsReturnNull = array(
        'count' => 1,
        'get'   => 1,
        'toh'   => 1, // toHtml() on blocks
    );
    protected $_mockMethodsReturnFalse = array(
        'can' => 1, // canCapture and all other payment related methods
        'has' => 1,
        'isa' => 1, // e.g. isAvailable -> Payment
        'isd' => 1, // e.g. isDiscounted e.g. Weee helper
        'ise' => 1, // e.g. isEnabled e.g. Weee helper
        'isg' => 1, // e.g. isGateway -> Payment
        'isi' => 1, // e.g. isInitializeNeeded -> Payment
        'ism' => 1, // e.g. isMessagesAvailable -> GiftMessage
        'iss' => 1, // e.g. isSubscribed
        'ist' => 1, // e.g. isTaxable in Weee
        'isv' => 1, // e.g. isValid...
        'isl' => 1, // e.g. isLoggedIn
        'use' => 1,
        'typ' => 1, // Weee Helper->typeofdisplay()
        'val' => 1, // Weee Helper->validateCatalogPricesAndFptConfiguration()
    );

    /**
     * @param Zookal_Mock_Helper_Data $helper
     */
    public function __construct($helper = null)
    {
        if (false === empty($helper) && $helper instanceof Zookal_Mock_Helper_Data) { // $helper is sometimes an empty array ...
            $this->_helper = $helper;
        }

        $this->_isLogEnabled = $this->getHelper()->isLogMethodEnabled();
    }

    /**
     * Add/Set/Get attribute wrapper
     *
     * @param string $method
     * @param array  $args
     *
     * @return $this|bool|null
     * @throws Varien_Exception
     */
    public function __call($method, $args)
    {
        $lowerMethod  = strtolower($method);
        $firstThree   = substr($lowerMethod, 0, 3);
        $isCollection = strpos($lowerMethod, 'collection') !== false;
        if (true === $isCollection || isset($this->_mockMethodsReturnThis[$lowerMethod]) || isset($this->_mockMethodsReturnThis[$firstThree])) {
            $this->_log($method . ' return this');
            return $this;
        }
        if (isset($this->_mockMethodsReturnNull[$lowerMethod]) || isset($this->_mockMethodsReturnNull[$firstThree])) {
            $this->_log($method . ' return null');
            return null;
        }
        if (isset($this->_mockMethodsReturnFalse[$firstThree]) || isset($this->_mockMethodsReturnFalse[$lowerMethod])) {
            $this->_log($method . ' return false');
            return false;
        }

        throw new Varien_Exception("Invalid method " . get_class($this) . "::" . $method . ' Cannot print args ...');
    }

    /**
     * Special case if Mage_Tag is disabled or any other module which rely on initLayoutMessages
     *
     * @return Mage_Core_Model_Message_Collection
     */
    public function getMessages()
    {
        return Mage::getModel('core/message_collection');
    }

    /**
     * uncomment this in dev env to see what methods are called
     *
     * @param $msg
     */
    protected function _log($msg)
    {
        if (true === $this->_isLogEnabled) {
            Mage::log(get_class($this) . '::' . $msg, null, 'mock.log');
        }
    }

    /**
     * @return Zookal_Mock_Helper_Data
     */
    public function getHelper()
    {
        if (null === $this->_helper) {
            $this->_helper = Mage::helper('zookal_mock');
        }
        return $this->_helper;
    }

    /**
     * @return array
     */
    public function getMockMethodsReturnFalse()
    {
        return $this->_mockMethodsReturnFalse;
    }

    /**
     * @return array
     */
    public function getMockMethodsReturnNull()
    {
        return $this->_mockMethodsReturnNull;
    }

    /**
     * @return array
     */
    public function getMockMethodsReturnThis()
    {
        return $this->_mockMethodsReturnThis;
    }
}