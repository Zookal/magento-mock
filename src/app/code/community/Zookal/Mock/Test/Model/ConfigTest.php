<?php

/**
 * @category    Zookal_Mock
 * @package     Helper
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Test_Model_ConfigTest extends EcomDev_PHPUnit_Test_Case
{
    protected $class = 'Zookal_Mock_Model_Config';

    /**
     * @param string|Varien_Simplexml_Element $sourceData
     *
     * @return Zookal_Mock_Model_Config
     */
    public function getInstance($sourceData = null)
    {
        return new $this->class($sourceData);
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
    public function itShouldExtendCoreModelConfig()
    {
        $this->assertInstanceOf('Mage_Core_Model_Config', $this->getInstance());
    }

    /**
     * @test
     */
    public function itShouldHaveMethods()
    {
        $methods = array(
            'getDisabledModules',
            'removeDependencies',
            'getDependencyLiars',
        );
        //$this->assertTrue(method_exists($this->class, ));
        $classMethods = array_flip(get_class_methods($this->class));
        foreach ($methods as $method) {
            $this->assertArrayHasKey($method, $classMethods);
        }
    }

    /**
     * @test
     */
    public function itShouldGetTheDisabledModules()
    {
        $disabledModules = $this->getInstance()->getDisabledModules($this->getModuleFixture());

        $this->assertCount(24, $disabledModules);
        $this->assertArrayHasKey('Mage_Backup', $disabledModules);
        $this->assertArrayHasKey('Phoenix_Moneybookers', $disabledModules);
    }

    /**
     * @test
     */
    public function itShouldRemoveTheDependencies()
    {
        $instance              = $this->getInstance();
        $liars                 = $instance->getDependencyLiars();
        $modulesNoDependencies = $instance->removeDependencies($this->getModuleFixture());

        foreach ($modulesNoDependencies as $module => $config) {
            if (isset($liars[$module]) && true === $config['active']) {
                $liarModules = $liars[$module];
                $depends     = $config['depends'];
                foreach ($liarModules as $liarModule) {
                    if (false === $modulesNoDependencies[$liarModule]['active']) {
                        $this->assertArrayNotHasKey($liarModule, $depends, $module . ' -> ' . $liarModule . ' -> ' . var_export($depends, 1));
                    }
                }
            }
        }
    }

    /**
     * @return array
     */
    protected function getModuleFixture()
    {
        return array(
            'Mage_Core'              =>
                array(
                    'module'  => 'Mage_Core',
                    'depends' =>
                        array(),
                    'active'  => true,
                ),
            'Mage_Eav'               =>
                array(
                    'module'  => 'Mage_Eav',
                    'depends' =>
                        array(
                            'Mage_Core' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Page'              =>
                array(
                    'module'  => 'Mage_Page',
                    'depends' =>
                        array(
                            'Mage_Core' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Install'           =>
                array(
                    'module'  => 'Mage_Install',
                    'depends' =>
                        array(
                            'Mage_Core' => true,
                        ),
                    'active'  => false,
                ),
            'Mage_Admin'             =>
                array(
                    'module'  => 'Mage_Admin',
                    'depends' =>
                        array(
                            'Mage_Core' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Rule'              =>
                array(
                    'module'  => 'Mage_Rule',
                    'depends' =>
                        array(
                            'Mage_Core' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Adminhtml'         =>
                array(
                    'module'  => 'Mage_Adminhtml',
                    'depends' =>
                        array(
                            'Mage_Admin' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_AdminNotification' =>
                array(
                    'module'  => 'Mage_AdminNotification',
                    'depends' =>
                        array(
                            'Mage_Core'      => true,
                            'Mage_Adminhtml' => true,
                        ),
                    'active'  => false,
                ),
            'Mage_Cron'              =>
                array(
                    'module'  => 'Mage_Cron',
                    'depends' =>
                        array(
                            'Mage_Core' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Directory'         =>
                array(
                    'module'  => 'Mage_Directory',
                    'depends' =>
                        array(
                            'Mage_Core' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Customer'          =>
                array(
                    'module'  => 'Mage_Customer',
                    'depends' =>
                        array(
                            'Mage_Eav'       => true,
                            'Mage_Dataflow'  => true,
                            'Mage_Directory' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Catalog'           =>
                array(
                    'module'  => 'Mage_Catalog',
                    'depends' =>
                        array(
                            'Mage_Eav'      => true,
                            'Mage_Dataflow' => true,
                            'Mage_Cms'      => true,
                            'Mage_Index'    => true,
                        ),
                    'active'  => true,
                ),
            'Mage_CatalogRule'       =>
                array(
                    'module'  => 'Mage_CatalogRule',
                    'depends' =>
                        array(
                            'Mage_Rule'     => true,
                            'Mage_Catalog'  => true,
                            'Mage_Customer' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_CatalogIndex'      =>
                array(
                    'module'  => 'Mage_CatalogIndex',
                    'depends' =>
                        array(
                            'Mage_Catalog'     => true,
                            'Mage_Eav'         => true,
                            'Mage_CatalogRule' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_CatalogSearch'     =>
                array(
                    'module'  => 'Mage_CatalogSearch',
                    'depends' =>
                        array(
                            'Mage_Catalog' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Sales'             =>
                array(
                    'module'  => 'Mage_Sales',
                    'depends' =>
                        array(
                            'Mage_Rule'     => true,
                            'Mage_Catalog'  => true,
                            'Mage_Customer' => true,
                            'Mage_Payment'  => true,
                        ),
                    'active'  => true,
                ),
            'Mage_SalesRule'         =>
                array(
                    'module'  => 'Mage_SalesRule',
                    'depends' =>
                        array(
                            'Mage_Rule'    => true,
                            'Mage_Catalog' => true,
                            'Mage_Sales'   => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Checkout'          =>
                array(
                    'module'  => 'Mage_Checkout',
                    'depends' =>
                        array(
                            'Mage_Sales'            => true,
                            'Mage_CatalogInventory' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Shipping'          =>
                array(
                    'module'  => 'Mage_Shipping',
                    'depends' =>
                        array(
                            'Mage_Core'    => true,
                            'Mage_Catalog' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Payment'           =>
                array(
                    'module'  => 'Mage_Payment',
                    'depends' =>
                        array(
                            'Mage_Core'    => true,
                            'Mage_Catalog' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Usa'               =>
                array(
                    'module'  => 'Mage_Usa',
                    'depends' =>
                        array(
                            'Mage_Sales'    => true,
                            'Mage_Shipping' => true,
                        ),
                    'active'  => false,
                ),
            'Mage_Paygate'           =>
                array(
                    'module'  => 'Mage_Paygate',
                    'depends' =>
                        array(
                            'Mage_Payment' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Paypal'            =>
                array(
                    'module'  => 'Mage_Paypal',
                    'depends' =>
                        array(
                            'Mage_Paygate'  => true,
                            'Mage_Checkout' => true,
                            'Mage_Sales'    => true,
                        ),
                    'active'  => false,
                ),
            'Mage_PaypalUk'          =>
                array(
                    'module'  => 'Mage_PaypalUk',
                    'depends' =>
                        array(
                            'Mage_Paygate'  => true,
                            'Mage_Checkout' => true,
                            'Mage_Sales'    => true,
                            'Mage_Paypal'   => true,
                        ),
                    'active'  => false,
                ),
            'Mage_GoogleCheckout'    =>
                array(
                    'module'  => 'Mage_GoogleCheckout',
                    'depends' =>
                        array(
                            'Mage_Sales'   => true,
                            'Mage_Payment' => true,
                            'Mage_Usa'     => true,
                        ),
                    'active'  => false,
                ),
            'Mage_Log'               =>
                array(
                    'module'  => 'Mage_Log',
                    'depends' =>
                        array(
                            'Mage_Core'     => true,
                            'Mage_Customer' => true,
                        ),
                    'active'  => false,
                ),
            'Mage_Backup'            =>
                array(
                    'module'  => 'Mage_Backup',
                    'depends' =>
                        array(
                            'Mage_Core' => true,
                        ),
                    'active'  => false,
                ),
            'Mage_Poll'              =>
                array(
                    'module'  => 'Mage_Poll',
                    'depends' =>
                        array(
                            'Mage_Core' => true,
                            'Mage_Cms'  => true,
                        ),
                    'active'  => false,
                ),
            'Mage_Rating'            =>
                array(
                    'module'  => 'Mage_Rating',
                    'depends' =>
                        array(
                            'Mage_Core'   => true,
                            'Mage_Review' => true,
                        ),
                    'active'  => false,
                ),
            'Mage_Review'            =>
                array(
                    'module'  => 'Mage_Review',
                    'depends' =>
                        array(
                            'Mage_Catalog' => true,
                            'Mage_Core'    => true,
                        ),
                    'active'  => false,
                ),
            'Mage_Tag'               =>
                array(
                    'module'  => 'Mage_Tag',
                    'depends' =>
                        array(
                            'Mage_Catalog' => true,
                        ),
                    'active'  => false,
                ),
            'Mage_Cms'               =>
                array(
                    'module'  => 'Mage_Cms',
                    'depends' =>
                        array(
                            'Mage_Core' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Reports'           =>
                array(
                    'module'  => 'Mage_Reports',
                    'depends' =>
                        array(
                            'Mage_Customer' => true,
                            'Mage_Catalog'  => true,
                            'Mage_Sales'    => true,
                            'Mage_Cms'      => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Newsletter'        =>
                array(
                    'module'  => 'Mage_Newsletter',
                    'depends' =>
                        array(
                            'Mage_Core'     => true,
                            'Mage_Customer' => true,
                            'Mage_Eav'      => true,
                            'Mage_Widget'   => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Tax'               =>
                array(
                    'module'  => 'Mage_Tax',
                    'depends' =>
                        array(
                            'Mage_Catalog'  => true,
                            'Mage_Customer' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Wishlist'          =>
                array(
                    'module'  => 'Mage_Wishlist',
                    'depends' =>
                        array(
                            'Mage_Customer' => true,
                            'Mage_Catalog'  => true,
                        ),
                    'active'  => false,
                ),
            'Mage_GoogleAnalytics'   =>
                array(
                    'module'  => 'Mage_GoogleAnalytics',
                    'depends' =>
                        array(
                            'Mage_Core' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_CatalogInventory'  =>
                array(
                    'module'  => 'Mage_CatalogInventory',
                    'depends' =>
                        array(
                            'Mage_Catalog' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_GiftMessage'       =>
                array(
                    'module'  => 'Mage_GiftMessage',
                    'depends' =>
                        array(
                            'Mage_Catalog' => true,
                            'Mage_Sales'   => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Sendfriend'        =>
                array(
                    'module'  => 'Mage_Sendfriend',
                    'depends' =>
                        array(
                            'Mage_Catalog' => true,
                        ),
                    'active'  => false,
                ),
            'Mage_Media'             =>
                array(
                    'module'  => 'Mage_Media',
                    'depends' =>
                        array(
                            'Mage_Core' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Sitemap'           =>
                array(
                    'module'  => 'Mage_Sitemap',
                    'depends' =>
                        array(
                            'Mage_Catalog' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Contacts'          =>
                array(
                    'module'  => 'Mage_Contacts',
                    'depends' =>
                        array(
                            'Mage_Core' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Dataflow'          =>
                array(
                    'module'  => 'Mage_Dataflow',
                    'depends' =>
                        array(
                            'Mage_Core' => true,
                        ),
                    'active'  => false,
                ),
            'Mage_Rss'               =>
                array(
                    'module'  => 'Mage_Rss',
                    'depends' =>
                        array(
                            'Mage_Catalog'          => true,
                            'Mage_CatalogInventory' => true,
                            'Mage_Sales'            => true,
                            'Mage_SalesRule'        => true,
                            'Mage_Wishlist'         => true,
                        ),
                    'active'  => false,
                ),
            'Mage_ProductAlert'      =>
                array(
                    'module'  => 'Mage_ProductAlert',
                    'depends' =>
                        array(
                            'Mage_Catalog'  => true,
                            'Mage_Customer' => true,
                        ),
                    'active'  => false,
                ),
            'Mage_Index'             =>
                array(
                    'module'  => 'Mage_Index',
                    'depends' =>
                        array(
                            'Mage_Core' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Api'               =>
                array(
                    'module'  => 'Mage_Api',
                    'depends' =>
                        array(
                            'Mage_Core' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Api2'              =>
                array(
                    'module'  => 'Mage_Api2',
                    'depends' =>
                        array(
                            'Mage_Core'  => true,
                            'Mage_Oauth' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Authorizenet'      =>
                array(
                    'module'  => 'Mage_Authorizenet',
                    'depends' =>
                        array(
                            'Mage_Paygate'  => true,
                            'Mage_Sales'    => true,
                            'Mage_Checkout' => true,
                        ),
                    'active'  => false,
                ),
            'Mage_Bundle'            =>
                array(
                    'module'  => 'Mage_Bundle',
                    'depends' =>
                        array(
                            'Mage_Catalog' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Captcha'           =>
                array(
                    'module'  => 'Mage_Captcha',
                    'depends' =>
                        array(
                            'Mage_Customer'  => true,
                            'Mage_Adminhtml' => true,
                        ),
                    'active'  => false,
                ),
            'Mage_Centinel'          =>
                array(
                    'module'  => 'Mage_Centinel',
                    'depends' =>
                        array(
                            'Mage_Payment'  => true,
                            'Mage_Checkout' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Compiler'          =>
                array(
                    'module'  => 'Mage_Compiler',
                    'depends' =>
                        array(
                            'Mage_Core' => true,
                        ),
                    'active'  => false,
                ),
            'Mage_Connect'           =>
                array(
                    'module'  => 'Mage_Connect',
                    'depends' =>
                        array(),
                    'active'  => false,
                ),
            'Mage_CurrencySymbol'    =>
                array(
                    'module'  => 'Mage_CurrencySymbol',
                    'depends' =>
                        array(
                            'Mage_Widget' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Downloadable'      =>
                array(
                    'module'  => 'Mage_Downloadable',
                    'depends' =>
                        array(
                            'Mage_Catalog' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_ImportExport'      =>
                array(
                    'module'  => 'Mage_ImportExport',
                    'depends' =>
                        array(
                            'Mage_Catalog' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Oauth'             =>
                array(
                    'module'  => 'Mage_Oauth',
                    'depends' =>
                        array(
                            'Mage_Core' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_PageCache'         =>
                array(
                    'module'  => 'Mage_PageCache',
                    'depends' =>
                        array(
                            'Mage_Core' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Persistent'        =>
                array(
                    'module'  => 'Mage_Persistent',
                    'depends' =>
                        array(
                            'Mage_Adminhtml' => true,
                            'Mage_Checkout'  => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Weee'              =>
                array(
                    'module'  => 'Mage_Weee',
                    'depends' =>
                        array(
                            'Mage_Catalog' => true,
                            'Mage_Tax'     => true,
                            'Mage_Sales'   => true,
                        ),
                    'active'  => true,
                ),
            'Mage_Widget'            =>
                array(
                    'module'  => 'Mage_Widget',
                    'depends' =>
                        array(
                            'Mage_Cms' => true,
                        ),
                    'active'  => true,
                ),
            'Mage_XmlConnect'        =>
                array(
                    'module'  => 'Mage_XmlConnect',
                    'depends' =>
                        array(
                            'Mage_Checkout'         => true,
                            'Mage_Paypal'           => true,
                            'Mage_Usa'              => true,
                            'Mage_Tax'              => true,
                            'Mage_Weee'             => true,
                            'Mage_Catalog'          => true,
                            'Mage_CatalogSearch'    => true,
                            'Mage_CatalogInventory' => true,
                            'Mage_Bundle'           => true,
                            'Mage_Wishlist'         => true,
                            'Mage_Rating'           => true,
                            'Mage_Review'           => true,
                        ),
                    'active'  => false,
                ),

            'Phoenix_Moneybookers'   =>
                array(
                    'module'  => 'Phoenix_Moneybookers',
                    'depends' =>
                        array(),
                    'active'  => false,
                ),

            'Mage_GoogleBase'        =>
                array(
                    'module'  => 'Mage_GoogleBase',
                    'depends' =>
                        array(),
                    'active'  => false,
                ),

        );
    }
}