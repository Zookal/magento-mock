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
class Mage_Tag_Model_Tag extends Zookal_Mock_Model_Mocks_Abstract
{
    /**
     * Constants are needed for Magento >= 1.2.0
     * Check here https://github.com/wlvrn/magento-community for all 72 releases of CE Magento
     */
    const STATUS_DISABLED = -1;
    const STATUS_PENDING  = 0;
    const STATUS_APPROVED = 1;
}
