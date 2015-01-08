<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */

/**
 * Class Mage_Weee_Helper_Data
 * Do not change the class name, as it is needed for the autoloader
 * @see Zookal_Mock_Model_Observer::_setMockIncludePath
 */
class Mage_Weee_Helper_Data extends Zookal_Mock_Model_Mocks_Abstract
{

    /**
     * Fixes a bug in Mage_Tax_Block_Checkout_Tax::getAllWeee() where getApplied() cannot return null
     * as otherwise the foreach would fail
     *
     * Returns applied weee taxes
     *
     * @param Mage_Sales_Model_Quote_Item_Abstract $item
     *
     * @return array
     */
    public function getApplied($item)
    {
        return array();
    }
}
