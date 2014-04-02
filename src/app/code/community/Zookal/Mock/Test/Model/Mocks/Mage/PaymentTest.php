<?php

/**
 * @category    Zookal_Mock
 * @package     Test
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Test_Model_Mocks_Mage_PaymentTest extends Zookal_Mock_Test_Model_Mocks_Mage_AbstractPHPUnitTestCase
{
    protected $class = 'Zookal_Mock_Model_Mocks_Mage_Payment';

    /**
     * @param boolean $isAdmin
     *
     * @return mixed
     */
    public function getInstance($isAdmin = false)
    {
        $stubStore = $this->getMock('Mage_Core_Model_Store');
        $stubStore->expects($this->any())
            ->method('isAdmin')
            ->will($this->returnValue($isAdmin));
        return new $this->class(null, $stubStore);
    }

    /**
     * @test
     */
    public function itShouldHaveAGetInfoBlockType()
    {
        $this->assertTrue(method_exists($this->class, 'getInfoBlockType'));
    }

    /**
     * @test
     */
    public function itShouldHaveAGetMethodFormBlock()
    {
        $this->assertTrue(method_exists($this->class, 'getMethodFormBlock'));
    }

    /**
     * @test
     */
    public function itShouldReturnTheInfoBlockTypeFrontend()
    {
        $this->assertEquals('zookal_mock/payment_frontend', $this->getInstance(false)->getInfoBlockType());
    }

    /**
     * @test
     */
    public function itShouldReturnTheInfoBlockTypeBackend()
    {
        $this->assertEquals('zookal_mock/payment_backend', $this->getInstance(true)->getInfoBlockType());
    }

    /**
     * @test
     */
    public function itShouldReturnThePaymentBlockBackend()
    {
        $this->assertInstanceOf('Zookal_Mock_Block_Payment_Backend', $this->getInstance()->getMethodFormBlock());
    }
}