<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Model_Mocks_Mage_Group extends Zookal_Mock_Model_Mocks_Abstract
{
    /**
     * @see table tax_class
     *
     * @return int
     */
    public function getTaxClassId()
    {
        return 1;
    }
}