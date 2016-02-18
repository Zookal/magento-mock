<?php
/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Chris Zaharia | @chrisjz
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */

/**
 * Class Mage_AdminNotification_Model_Feed
 * @see Zookal_Mock_Model_Observer::_setMockIncludePath
 */
class Mage_AdminNotification_Model_Feed extends Zookal_Mock_Model_Mocks_Abstract
{
    const XML_USE_HTTPS_PATH    = 'system/adminnotification/use_https';
    const XML_FEED_URL_PATH     = 'system/adminnotification/feed_url';
    const XML_FREQUENCY_PATH    = 'system/adminnotification/frequency';
    const XML_LAST_UPDATE_PATH  = 'system/adminnotification/last_update';
}
