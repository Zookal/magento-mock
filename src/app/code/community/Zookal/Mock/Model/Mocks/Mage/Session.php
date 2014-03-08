<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Model_Mocks_Mage_Session extends Zookal_Mock_Model_Mocks_Abstract
{
    /**
     * also used in Mage_Catalog_Model_Resource_Product_Collection::addPriceData
     *
     * @return int
     */
    public function getCustomerGroupId()
    {
        return 0;
    }
}