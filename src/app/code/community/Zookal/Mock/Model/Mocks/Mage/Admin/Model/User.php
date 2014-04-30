<?php
/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */

/**
 * Class Mage_Admin_Model_User
 * Do not change the class name, as it is needed for the autoloader because this class is somewhere in Magentos source code hardcoded :-(
 * @see Zookal_Mock_Model_Observer::_setMockIncludePath
 * @needed in Mage_Customer_Model_Customer::hashPassword()
 */
class Mage_Admin_Model_User
{

    /**
     * Minimum length of admin password
     */
    const MIN_PASSWORD_LENGTH = 7;

    /**
     * Length of salt
     */
    const HASH_SALT_LENGTH = 32;
}
