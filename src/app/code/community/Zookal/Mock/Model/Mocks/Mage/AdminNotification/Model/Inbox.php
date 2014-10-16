<?php
/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */

/**
 * Class Mage_AdminNotification_Model_Inbox
 * Do not change the class name, as it is needed for the autoloader because this class is
 * somewhere in a source code hardcoded :-(
 * @see Zookal_Mock_Model_Observer::_setMockIncludePath
 */
class Mage_AdminNotification_Model_Inbox extends Zookal_Mock_Model_Mocks_Abstract
{
    const SEVERITY_CRITICAL = 1;
    const SEVERITY_MAJOR = 2;
    const SEVERITY_MINOR = 3;
    const SEVERITY_NOTICE = 4;

    /**
     * Parse and save new data
     *
     * @param array $data
     *
     * @return Mage_AdminNotification_Model_Inbox
     */
    public function parse(array $data)
    {
        Mage::log($data, null, 'magento_mock_admin_inbox.log');
        return $this;
    }
}
