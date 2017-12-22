<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Chris Zaharia| {firstName}@{lastName}.fm | @chrisjz
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */

/**
 * Class Mage_Log_Helper_Data
 * Do not change the class name, as it is needed for the autoloader
 * @see Zookal_Mock_Model_Observer::_setMockIncludePath
 */
class Mage_Log_Helper_Data extends Zookal_Mock_Model_Mocks_Abstract
{
    public function isVisitorLogEnabled()
    {
        return true;
    }

    public function isLogFileExtensionValid($file)
    {
        return true;
    }
}
