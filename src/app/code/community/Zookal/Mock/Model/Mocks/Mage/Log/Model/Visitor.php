<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */

/**
 * Class Mage_Log_Model_Visitor
 * Do not change the class name, as it is needed for the autoloader because this class is somewhere in Magentos source code hardcoded :-(
 * @see Zookal_Mock_Model_Observer::_setMockIncludePath
 */
class Mage_Log_Model_Visitor extends Zookal_Mock_Model_Mocks_Abstract
{
    /**
     * Constants are needed for Magento >= 1.1.7
     * Check here https://github.com/wlvrn/magento-community for all 72 releases of CE Magento
     */
    const DEFAULT_ONLINE_MINUTES_INTERVAL = 15;
    const VISITOR_TYPE_CUSTOMER           = 'c';
    const VISITOR_TYPE_VISITOR            = 'v';

    /**
     * @return int
     */
    public static function getOnlineMinutesInterval()
    {
        return 0;
    }
}
