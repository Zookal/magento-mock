<?php

/**
 * @category    Zookal_Mock
 * @package     Helper
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
abstract class Zookal_Mock_Model_Mocks_Abstract
{

    protected $_mockMethodsReturnThis = array(
        'add'            => 1, // e.g. addCustomerFilter ...
        'loa'            => 1, // e.g. load and loadBy....
        'set'            => 1,
        'uns'            => 1,
        'cle'            => 1, // e.g. clean() clear() clearasil()
        'too'            => 1, // e.g. toOptionArray, toOptionHash
        'resetsortorder' => 1,
        'renewsession'   => 1,
    );
    protected $_mockMethodsReturnNull = array(
        'get'   => 1,
        'count' => 1,
    );
    protected $_mockMethodsReturnFalse = array(
        'has' => 1,
        'use' => 1,
        'isv' => 1, // e.g. isValid...
    );

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
        if (isset($this->_mockMethodsReturnFalse[$firstThree])) {
            $this->_log($method . ' return false');
            return false;
        }

        throw new Varien_Exception("Invalid method " . get_class($this) . "::" . $method . "(" . print_r($args, 1) . ")");
    }

    /**
     * Special case if Mage_Tag is disabled or any other module which rely on initLayoutMessages
     *
     * @return false|Mage_Core_Model_Abstract
     */
    public function getMessages()
    {
        return Mage::getModel('core/message_collection');
    }

    protected function _log($msg)
    {
        //Mage::log(get_class($this) . '::' . $msg, null, 'mock.log');
    }
}