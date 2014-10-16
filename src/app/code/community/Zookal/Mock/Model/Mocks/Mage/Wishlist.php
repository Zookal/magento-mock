<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Model_Mocks_Mage_Wishlist extends Zookal_Mock_Model_Mocks_AbstractIterator
{

    /**
     * @needed in Mage_Adminhtml_Block_Sales_Order_Create_Sidebar_Abstract::getItems()
     * @return $this
     */
    public function getItems()
    {
        return $this;
    }
}