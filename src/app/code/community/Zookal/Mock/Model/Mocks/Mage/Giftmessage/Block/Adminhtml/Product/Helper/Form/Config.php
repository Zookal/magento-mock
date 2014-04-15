<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Mage_GiftMessage_Block_Adminhtml_Product_Helper_Form_Config extends Mage_Adminhtml_Block_Catalog_Product_Helper_Form_Config
{
    /**
     * Return nothing
     *
     * @return string
     */
    public function getElementHtml()
    {
        return '<strong>' . Mage::helper('zookal_mock')->__('Module Disabled!') . '</strong>';
    }
}
