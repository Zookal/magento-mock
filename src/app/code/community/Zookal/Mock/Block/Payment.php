<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Block_Payment extends Zookal_Mock_Model_Mocks_Abstract
{
    /**
     * @var Mage_Sales_Model_Order_Payment
     */
    protected $_payment = null;

    protected $_html = '<strong>Mock Payment Info:</strong>{{paymentInfo}}';

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
     * @return string
     */
    public function toHtml()
    {
        Mage::dispatchEvent('mock_payment_block_to_html_before', array('block' => $this, 'payment' => $this->_payment));
        return strpos($this->_html, '{{paymentInfo}}') === false ? $this->_html : str_replace('{{paymentInfo}}', $this->_getPaymentInfoTable(), $this->_html);
    }

    /**
     * @return string
     */
    protected function _getPaymentInfoTable()
    {
        $debug = $this->_payment->debug();
        ksort($debug);
        $data = array('<table>');
        foreach ($debug as $k => $v) {
            if (!empty($v)) {
                $data[] = '<tr><td>' . $k . '</td><td>' . $v . '</td></tr>';
            }
        }
        $data[] = '</table>';
        return implode("\n", $data);
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