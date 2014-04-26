<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */

/**
 * Class Mage_Shipping_Model_Shipping
 * Do not change the class name, as it is needed for the autoloader because this class is somewhere in Magentos source code hardcoded :-(
 * @see Zookal_Mock_Model_Observer::_setMockIncludePath
 */
class Mage_Shipping_Model_Shipping extends Zookal_Mock_Model_Mocks_Abstract
{
    const XML_PATH_STORE_COUNTRY_ID = 'shipping/mock/fake_country_id';
    const XML_PATH_ORIGIN_REGION_ID = 'shipping/mock/fake_region_id';
    const XML_PATH_ORIGIN_CITY      = 'shipping/mock/fake_city';
    const XML_PATH_ORIGIN_POSTCODE  = 'shipping/mock/fake_postcode';
    const XML_PATH_STORE_ADDRESS1   = 'shipping/mock/fake_street_line1';
    const XML_PATH_STORE_ADDRESS2   = 'shipping/mock/fake_street_line2';
    const XML_PATH_STORE_CITY       = 'shipping/mock/fake_city';
    const XML_PATH_STORE_REGION_ID  = 'shipping/mock/fake_region_id';
    const XML_PATH_STORE_ZIP        = 'shipping/mock/fake_postcode';
}
