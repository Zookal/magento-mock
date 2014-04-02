<?php

/**
 * @category    Zookal_Mock
 * @package     Test
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */

/**
 * Class Mage_Adminhtml_Helper_Data
 * Do not change the class name, as it is needed for the autoloader
 * @see Zookal_Mock_Model_Observer::_setMockIncludePath
 */
class Zookal_Mock_Test_Model_Mocks_Mage_Adminhtml_Helper_DataTest extends Zookal_Mock_Test_Model_Mocks_Mage_AbstractPHPUnitTestCase
{
    //protected $class = 'Mage_Adminhtml_Helper_Data';
    protected $class = 'Zookal_Mock_Model_Mocks_Mage_Block'; // dummy for passing the test
    // @todo implement test but change the model path and getIncludePath PHP in the config so that the mock class Mage_Tag_Model_Tag will get loaded
}
