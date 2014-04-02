<?php

/**
 * @category    Zookal_Mock
 * @package     Helper
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Test_Model_Mocks_AbstractTest extends EcomDev_PHPUnit_Test_Case
{
    protected $class = 'Zookal_Mock_Model_Mocks_Abstract';

    /**
     * @return Zookal_Mock_Model_Mocks_Abstract
     */
    public function getInstance()
    {
        return $this->getMockForAbstractClass($this->class);
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
        $this->assertInstanceOf($this->class, $this->getInstance());
    }

    /**
     * @test
     */
    public function itShouldHaveAMethod__Call()
    {
        $this->assertTrue(method_exists($this->class, '__call'));
    }

    /**
     * @test
     */
    public function itShouldHaveAMethodGetMessages()
    {
        $this->assertTrue(method_exists($this->class, 'getMessages'));
    }

    /**
     * @test
     */
    public function itShouldHaveAMethodGetMockMethodsReturnThis()
    {
        $this->assertTrue(method_exists($this->class, 'getMockMethodsReturnThis'));
    }

    /**
     * @test
     */
    public function itShouldHaveAMethodgetMockMethodsReturnNull()
    {
        $this->assertTrue(method_exists($this->class, 'getMockMethodsReturnNull'));
    }

    /**
     * @test
     */
    public function itShouldHaveAMethodgetMockMethodsReturnFalse()
    {
        $this->assertTrue(method_exists($this->class, 'getMockMethodsReturnFalse'));
    }

    /**
     * @test
     */
    public function itShouldReturnAMessageCollectionWhenCallingGetMessagesMethod()
    {
        $this->assertInstanceOf('Mage_Core_Model_Message_Collection', $this->getInstance()->getMessages());
    }

    /**
     * @test
     */
    public function itShouldReturnTheMocksHelper()
    {
        $this->assertInstanceOf('Zookal_Mock_Helper_Data', $this->getInstance()->getHelper());
    }

    /**
     * @test
     */
    public function itShouldReturnThis()
    {
        $instance    = $this->getInstance();
        $thisMethods = $instance->getMockMethodsReturnThis();
        foreach ($thisMethods as $method => $int) {
            $this->assertInstanceOf($this->class, $instance->$method());
        }
    }

    /**
     * @test
     */
    public function itShouldReturnThisWhenCallingACollection()
    {
        $instance = $this->getInstance();
        $this->assertInstanceOf($this->class, $instance->getWildCatsCollection());
    }

    /**
     * @test
     */
    public function itShouldReturnNull()
    {
        $instance    = $this->getInstance();
        $thisMethods = $instance->getMockMethodsReturnNull();
        foreach ($thisMethods as $method => $int) {
            $this->assertNull($instance->$method());
        }
    }

    /**
     * @test
     */
    public function itShouldReturnFalse()
    {
        $instance    = $this->getInstance();
        $thisMethods = $instance->getMockMethodsReturnFalse();
        foreach ($thisMethods as $method => $int) {
            $this->assertFalse($instance->$method());
        }
    }

    /**
     * @test
     * @expectedException Varien_Exception
     */
    public function itShouldThrowAnExceptionWhenCallingUnknownMethod()
    {
        $this->getInstance()->zzz();
    }
}