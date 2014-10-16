<?php

/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */
abstract class Zookal_Mock_Model_Mocks_AbstractIterator
    extends Zookal_Mock_Model_Mocks_Abstract
    implements IteratorAggregate
{
    /**
     * Implementation of IteratorAggregate::getIterator()
     */
    public function getIterator()
    {
        return new ArrayIterator(array());
    }
}
