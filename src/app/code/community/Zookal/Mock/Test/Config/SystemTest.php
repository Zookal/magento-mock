<?php

/**
 * @category    Zookal_Mock
 * @package     Helper
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
class Zookal_Mock_Test_Config_SystemTest extends PHPUnit_Framework_TestCase
{
    protected function getFile()
    {
        $dir = Mage::getModuleDir('etc', 'Zookal_Mock');
        return "$dir/system.xml";
    }

    protected function getXml()
    {
        $file = $this->getFile();
        $xml  = simplexml_load_file($file);
        return $xml;
    }

    public function assertFieldDefined($path, $message = '')
    {
        $defaultMessage = '';
        @list($section, $group, $field) = explode('/', $path);
        $nodePath = "sections/$section/groups/$group/fields/$field";
        $result   = $this->getXml()->xpath($nodePath);
        if (!$message) {
            $defaultMessage = sprintf("System configuration field \"$path\" not defined");
        }
        if (!$result) {
            $this->fail($message ? : $defaultMessage);
        }
    }

    /**
     * @test
     */
    public function itShouldHaveASystemXml()
    {
        $this->assertFileExists($this->getFile());
    }

    /**
     * @test
     */
    public function itShouldHaveAnApiUrlField()
    {
        $this->assertFieldDefined('system/zookalmock/enable_method_log');
    }
}