<?php

/**
 * @category    Zookal_Mock
 * @package     Helper
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Test_Config_ConfigTest extends EcomDev_PHPUnit_Test_Case_Config
{
    /**
     * @test
     */
    public function itShouldHaveASetupResource()
    {
        $this->assertModuleVersionGreaterThanOrEquals('1.0.0');
    }

    /**
     * @test
     */
    public function itShouldHaveAHelper()
    {
        $this->assertHelperAlias('zookal_mock', 'Zookal_Mock_Helper_Data');
    }

    /**
     * @test
     */
    public function itShouldHaveAConfigModel()
    {
        $configModel = Mage::getModel('zookal_mock/config');
        $this->assertInstanceOf('Mage_Core_Model_Config', $configModel);
    }

    /**
     * @test
     */
    public function itShouldHaveAControllerFrontInitBeforeObserver()
    {
        $this->assertEventObserverDefined('global', 'controller_front_init_before', 'zookal_mock/observer', 'mockDisabledModules');
    }

    /**
     * @test
     */
    public function itShouldHaveABlockAlias()
    {
        $this->assertBlockAlias('zookal_mock/payment_backend', 'Zookal_Mock_Block_Payment_Backend');
        $this->assertBlockAlias('zookal_mock/payment_frontend', 'Zookal_Mock_Block_Payment_Frontend');
    }

    /**
     * @test
     */
    public function itShouldHaveTheEnableMethodLog()
    {
        $this->assertDefaultConfigValue('system/zookalmock/enable_method_log', 0);
    }
}