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
     * Retrieve block type for display method information
     *
     * @return string
     */
    public function getInfoBlockType()
    {
        return 'zookal_mock/payment';
    }

    /**
     * Retreive payment method form html
     *
     *
     * @return  Zookal_Mock_Block_Empty
     */
    public function getMethodFormBlock()
    {
        return new Zookal_Mock_Block_Payment();
    }
}