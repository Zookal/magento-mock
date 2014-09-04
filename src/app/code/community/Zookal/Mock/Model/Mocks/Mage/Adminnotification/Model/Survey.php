<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */

/**
 * Class Mage_AdminNotification_Model_Survey
 * Do not change the class name, as it is needed for the autoloader because this class is somewhere in Magentos source code hardcoded :-(
 * @see Zookal_Mock_Model_Observer::_setMockIncludePath
 */
class Mage_AdminNotification_Model_Survey extends Zookal_Mock_Model_Mocks_Abstract
{
    public static function isSurveyViewed()
    {
        return true;
    }

    public static function isSurveyUrlValid()
    {
        return false;
    }

    public static function getSurveyUrl()
    {
        return '';
    }
}
