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
     * @var boolean
     */
    private $_includePathSet = null;

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

    /**
     * Appends a new include path to the current existing one.
     * Appending is for performance reasons mandatory
     *
     * @param array   $customFakePath
     * @param boolean $append
     *
     * @return bool
     */
    public function setMockPhpIncludePath(array $customFakePath = null, $append = true)
    {
        if (null === $this->_includePathSet) {
            $currentIncludePath = get_include_path();

            $customFakePath = null === $customFakePath
                ? array(
                    'app', 'code', 'community', 'Zookal', 'Mock', 'Model', 'Mocks'
                )
                : $customFakePath;

            $customFakePath = implode(DS, $customFakePath);
            if (strpos($currentIncludePath, $customFakePath) !== false) {
                $this->_includePathSet = false; // has already been set
                return $this->_includePathSet;
            }

            if (true === $append) {
                $includePath = get_include_path() . PS . BP . DS . $customFakePath;
            } else {
                $includePath = $customFakePath . PS . BP . DS . get_include_path();
            }

            $this->_includePathSet = set_include_path($includePath) !== false;
        } else {
            // every other call returns false as include path has already been set
            $this->_includePathSet = false;
        }

        return $this->_includePathSet;
    }
}