<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Model_Catalog_Model_Product extends Mage_Catalog_Model_Product
{

    /**
     * Use only if:
     * - you don't have your own Mage_Catalog_Model_Product rewrite
     * - Mage_Shipping is disabled
     *
     * If you have your own rewrite of Mage_Catalog_Model_Product add the method getIsVirtual()
     * Do not change anything in the database.
     *
     * @return bool
     */
    public function getIsVirtual()
    {
        return true;
    }
}
