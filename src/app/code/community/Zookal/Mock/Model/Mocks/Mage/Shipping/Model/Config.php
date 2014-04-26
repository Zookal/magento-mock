<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */

/**
 * needed when Mage_Shipping is disabled
 * Do not change the class name, as it is needed for the autoloader because this class is somewhere in Magentos source code hardcoded :-(
 * @see Zookal_Mock_Model_Observer::_setMockIncludePath
 * Class Zookal_Mock_Model_Mocks_Mage_Config
 */
class Mage_Shipping_Model_Config extends Zookal_Mock_Model_Mocks_Abstract
{
    /**
     * Shipping origin settings
     */
    const XML_PATH_ORIGIN_COUNTRY_ID = 'shipping/mock/fake_country_id';
    const XML_PATH_ORIGIN_REGION_ID  = 'shipping/mock/fake_region_id';
    const XML_PATH_ORIGIN_CITY       = 'shipping/mock/fake_city';
    const XML_PATH_ORIGIN_POSTCODE   = 'shipping/mock/fake_postcode';
}
