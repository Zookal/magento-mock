<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */

/**
 * Class Mage_Tag_Model_Tag
 * Do not change the class name, as it is needed for the autoloader because this class is somewhere in Magentos source code hardcoded :-(
 * @see Zookal_Mock_Model_Observer::_setMockIncludePath
 */
class Mage_Weee_Model_Tax extends Zookal_Mock_Model_Mocks_Abstract
{
    /**
     * constants are also used in catalog/product/price.html
     * Constants are needed for Magento >= 1.6.0
     * Check here https://github.com/wlvrn/magento-community for all 72 releases of CE Magento
     */
    /**
     * Including FPT only
     */
    const DISPLAY_INCL = 0;
    /**
     * Including FPT and FPT description
     */
    const DISPLAY_INCL_DESCR = 1;
    /**
     * Excluding FPT, FPT description, final price
     */
    const DISPLAY_EXCL_DESCR_INCL = 2;
    /**
     * Excluding FPT
     */
    const DISPLAY_EXCL = 3;
}
