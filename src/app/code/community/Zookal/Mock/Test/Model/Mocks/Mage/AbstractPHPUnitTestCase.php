<?php

/**
 * @category    Zookal_Mock
 * @package     Test
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
abstract class Zookal_Mock_Test_Model_Mocks_Mage_AbstractPHPUnitTestCase extends EcomDev_PHPUnit_Test_Case
{
    protected $class = null;

    public function getInstance()
    {
        return new $this->class;
    }

    /**
     * @test
     */
    public function itShouldExist()
    {
        $this->assertTrue(class_exists($this->class), "Failed asserting {$this->class} exists");
    }

    /**
     * @test
     */
    public function itShouldBeAnInstanceOfMocksAbstract()
    {
        $this->assertInstanceOf('Zookal_Mock_Model_Mocks_Abstract', $this->getInstance());
    }
}