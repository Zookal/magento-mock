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

    public function getInstance()
    {
        return new $this->class;
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
}