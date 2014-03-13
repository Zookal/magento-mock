<?php

/**
 * @category    Zookal_Mock
 * @package     Block
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Block_Payment_Backend extends Zookal_Mock_Model_Mocks_Abstract
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
        Mage::dispatchEvent('mock_payment_backend_block_to_html_before', array('block' => $this, 'payment' => $this->_payment));
        return strpos($this->_html, '{{paymentInfo}}') === false ? $this->_html : str_replace('{{paymentInfo}}', $this->_getPaymentInfoTable(), $this->_html);
    }

    /**
     * Moving that into a phtml file could be a little bit complicated and it's only backend ;-)
     * Use the observer to change the content.
     *
     * @return string
     */
    protected function _getPaymentInfoTable()
    {
        $debug = $this->_payment->debug();

        if (isset($debug['additional_information']) && is_array($debug['additional_information'])) {
            $ai = $debug['additional_information'];
            unset($debug['additional_information']);
            $debug = array_merge($debug, $ai);
        }

        ksort($debug);
        $data = array('<table>');
        foreach ($debug as $k => $v) {
            if (!empty($v)) {
                // you can translate here the column names into nicer names via the .csv files for the backend users
                $data[] = '<tr><td>' . Mage::helper('zookal_mock')->__($k) . '</td><td>' . $v . '</td></tr>';
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