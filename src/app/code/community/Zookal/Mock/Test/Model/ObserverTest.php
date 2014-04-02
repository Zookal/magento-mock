<?php

/**
 * @category    Zookal_Mock
 * @package     Helper
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Test_Model_ObserverTest extends EcomDev_PHPUnit_Test_Case
{
    protected $class = 'Zookal_Mock_Model_Observer';

    /**
     * @return Zookal_Mock_Model_Observer
     */
    public function getInstance()
    {
        $instance = new $this->class;

        return $instance;
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
    public function itShouldHaveAMethodMockDisabledModules()
    {
        $this->assertTrue(is_callable(array($this->class, 'mockDisabledModules')));
    }

    /**
     * @test
     */
    public function itShouldMockDisabledModules()
    {
        $this->assertTrue(true); // @todo
    }
}