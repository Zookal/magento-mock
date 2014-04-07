<?php

/**
 * @category    Zookal_Mock
 * @package     Helper
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Test_Helper_DataTest extends EcomDev_PHPUnit_Test_Case
{
    protected $class = 'Zookal_Mock_Helper_Data';

    /**
     * @param int $enabled
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    public function getStoreMock($enabled = 0)
    {
        $stubStore = $this->getMock('Mage_Core_Model_Store');
        $stubStore->expects($this->any())
            ->method('getConfig')
            ->with('system/zookalmock/enable_method_log')
            ->will($this->returnValue($enabled));
        return $stubStore;
    }

    /**
     * @param PHPUnit_Framework_MockObject_MockObject $mockStore
     *
     * @return Zookal_Mock_Helper_Data
     */
    public function getInstance($mockStore = null)
    {
        if (null === $mockStore) {
            $mockStore = $this->getStoreMock();
        }
        return new $this->class($mockStore);
    }

    /**
     * @test
     */
    public function itShouldExist()
    {
        $this->assertInstanceOf($this->class, $this->getInstance());
    }

    /**
     * @test
     */
    public function itShouldExtendTheHelperAbstract()
    {
        $this->assertInstanceOf('Mage_Core_Helper_Abstract', $this->getInstance());
    }

    /**
     * @test
     */
    public function itShouldHaveAGetStoreMethod()
    {
        $this->assertTrue(is_callable(array($this->class, 'getStore')));
    }

    /**
     * @test
     * @depends itShouldHaveAGetStoreMethod
     */
    public function itShouldReturnTheInjectedStoreModel()
    {
        $mockStore = $this->getMock('Mage_Core_Model_Store');
        $instance  = $this->getInstance($mockStore);
        $this->assertSame($mockStore, $instance->getStore());
    }

    /**
     * @test
     */
    public function itShouldHaveAMethodIsLogMethodEnabled()
    {
        $this->assertTrue(is_callable(array($this->class, 'isLogMethodEnabled')));
    }

    /**
     * @test
     * @depends itShouldHaveAMethodIsLogMethodEnabled
     */
    public function itShouldReturnEnabledLog()
    {
        $mockStore = $this->getStoreMock(1);
        $instance  = $this->getInstance($mockStore);
        $this->assertTrue($instance->isLogMethodEnabled());
    }

    /**
     * @test
     * @depends itShouldHaveAMethodIsLogMethodEnabled
     */
    public function itShouldReturnDisabledLog()
    {
        $mockStore = $this->getStoreMock(0);
        $instance  = $this->getInstance($mockStore);
        $this->assertFalse($instance->isLogMethodEnabled());
    }

    /**
     * @test
     */
    public function itShouldHaveAMethodSetMockPhpIncludePath()
    {
        $this->assertTrue(is_callable(array($this->class, 'setMockPhpIncludePath')));
    }

    /**
     * @test
     */
    public function itShouldNotSetTheMockPhpIncludePathAgain()
    {
        $this->assertFalse($this->getInstance()->setMockPhpIncludePath());
        $newIncludePath = get_include_path();
        $this->assertContains('app/code/community/Zookal/Mock/Model/Mocks', $newIncludePath);
    }
}