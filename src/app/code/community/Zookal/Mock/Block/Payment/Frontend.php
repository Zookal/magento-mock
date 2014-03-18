<?php

/**
 * @category    Zookal_Mock
 * @package     Block
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */

/**
 * core/layout checks if a block is an instance of Mage_Core_Block_Abstract otherwise FE rendering fails :-(
 *
 * Class Zookal_Mock_Block_Payment_Frontend
 */
class Zookal_Mock_Block_Payment_Frontend extends Mage_Core_Block_Abstract
{
    /**
     * @var Mage_Sales_Model_Order_Payment
     */
    protected $_payment = null;

    /**
     * @var string
     */
    protected $_html = '{{method}}';

    /**
     * Please use event core_block_abstract_to_html_before
     *
     * @return string
     */
    protected function _toHtml()
    {
        return strpos($this->_html, '{{method}}') === false ? $this->_html : $this->__(str_replace('{{method}}', $this->getInfo()->getMethod(),
            $this->_html));
    }

    /**
     * @param Mage_Sales_Model_Order_Payment $payment
     *
     * @return $this
     */
    public function setInfo(Mage_Sales_Model_Order_Payment $payment)
    {
        $this->_payment = $payment;
        return $this;
    }

    /**
     * @return Mage_Sales_Model_Order_Payment
     */
    public function getInfo()
    {
        return $this->_payment;
    }

    /**
     * @param string $html
     */
    public function setHtml($html)
    {
        $this->_html = $html;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        return $this->_html;
    }
}