<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class SequentialOneToOneTest extends TestCase
{
    /**
     * @dataProvider dataProviderOneToOne
     * @param SequentialOneToOne $c
     * @param int $offset
     * @param mixed $key
     * @param mixed $value
     */
    public function testItemAtOffset(SequentialOneToOne $c, $offset, $value, $key)
    {
        $this->assertSequentialEntry($key, $value, $offset, $c->itemAtOffset($offset));
    }

    /**
     * @dataProvider dataProviderOneToOne
     * @param SequentialOneToOne $c
     * @param int $offset
     * @param mixed $key
     * @param mixed $value
     */
    public function testItemOfKey(SequentialOneToOne $c, $offset, $value, $key)
    {
        $this->assertSequentialEntry($key, $value, $offset, $c->itemOfKey($key));
    }

    /**
     * @dataProvider dataProviderOneToOne
     * @param SequentialOneToOne $c
     * @param int $offset
     * @param mixed $key
     * @param mixed $value
     */
    public function testItemOfValue(SequentialOneToOne $c, $offset, $value, $key)
    {
        $this->assertSequentialEntry($key, $value, $offset, $c->itemOfValue($value));
    }

    /**
     * @dataProvider dataProviderOneToOne
     * @param SequentialOneToOne $c
     * @param int $offset
     * @param mixed $key
     * @param mixed $value
     */
    public function testOffsetOfItem(SequentialOneToOne $c, $offset, $value, $key)
    {
        $this->assertEquals($offset, $c->offsetOfItem(new Item($key, $value)));
    }

    /**
     * @dataProvider dataProviderOneToOne
     * @param SequentialOneToOne $c
     * @param int $offset
     * @param mixed $key
     * @param mixed $value
     */
    public function testKeyAtOffset(SequentialOneToOne $c, $offset, $value, $key)
    {
        $this->assertEquals($key, $c->keyAtOffset($offset));
    }

    /**
     * @dataProvider dataProviderOneToOne
     * @param SequentialOneToOne $c
     * @param int $offset
     * @param mixed $key
     * @param mixed $value
     */
    public function testOffsetOfKey(SequentialOneToOne $c, $offset, $value, $key)
    {
        $this->assertEquals($offset, $c->offsetOfKey($key));
    }

    /**
     * @dataProvider dataProviderOneToOne
     * @param SequentialOneToOne $c
     * @param int $offset
     * @param mixed $key
     * @param mixed $value
     */
    public function testValueAtOffset(SequentialOneToOne $c, $offset, $value, $key)
    {
        $this->assertEquals($value, $c->valueAtOffset($offset));
    }

    /**
     * @dataProvider dataProviderOneToOne
     * @param SequentialOneToOne $c
     * @param int $offset
     * @param mixed $key
     * @param mixed $value
     */
    public function testOffsetOfValue(SequentialOneToOne $c, $offset, $value, $key)
    {
        $this->assertEquals($offset, $c->offsetOfValue($value));
    }

    /**
     * @dataProvider dataProviderOneToOne
     * @param SequentialOneToOne $c
     * @param int $offset
     * @param mixed $key
     * @param mixed $value
     */
    public function testKeyOfValue(SequentialOneToOne $c, $offset, $value, $key)
    {
        $this->assertEquals($key, $c->keyOfValue($value));
    }

    /**
     * @dataProvider dataProviderOneToOne
     * @param SequentialOneToOne $c
     * @param int $offset
     * @param mixed $key
     * @param mixed $value
     */
    public function testValueOfKey(SequentialOneToOne $c, $offset, $value, $key)
    {
        $this->assertEquals($value, $c->valueOfKey($key));
    }
}
