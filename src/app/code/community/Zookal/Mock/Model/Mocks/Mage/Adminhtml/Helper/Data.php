<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */

/**
 * Class Mage_Adminhtml_Helper_Data
 * Do not change the class name, as it is needed for the autoloader
 * @see Zookal_Mock_Model_Observer::_setMockIncludePath
 */
class Mage_Adminhtml_Helper_Data extends Zookal_Mock_Model_Mocks_Abstract
{
    /**
     * Constants are needed for Magento >= 1.6
     * Check here https://github.com/wlvrn/magento-community for all 72 releases of CE Magento
     */
    const XML_PATH_ADMINHTML_ROUTER_FRONTNAME = 'admin/routers/adminhtml/args/frontName';
    const XML_PATH_USE_CUSTOM_ADMIN_URL       = 'default/admin/url/use_custom';
    const XML_PATH_USE_CUSTOM_ADMIN_PATH      = 'default/admin/url/use_custom_path';
    const XML_PATH_CUSTOM_ADMIN_PATH          = 'default/admin/url/custom_path';
}
