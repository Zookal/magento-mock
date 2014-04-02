<?php

/**
 * @category    Zookal_Mock
 * @package     Test
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Test_Model_Mocks_Mage_SessionTest extends Zookal_Mock_Test_Model_Mocks_Mage_AbstractPHPUnitTestCase
{
    protected $class = 'Zookal_Mock_Model_Mocks_Mage_Session';

    /**
     * @test
     */
    public function itShouldHaveMethodGetCustomerGroupId()
    {
        $this->assertTrue(method_exists($this->class, 'getCustomerGroupId'));
    }

    /**
     * @test
     */
    public function itShouldReturnZero()
    {
        $this->assertEquals(0, $this->getInstance()->getCustomerGroupId());
    }
}