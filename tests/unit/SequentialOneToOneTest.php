<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\Item;
use ProjxIO\Collections\Common\SequentialOneToOne;

class SequentialOneToOneTest extends TestCase
{
    public function dataProviderOneToOne()
    {
        $keys = $this->generateArrayOfObjects(self::$size);
        $values = $this->generateArrayOfObjects(self::$size);

        $collections = [
            new ArraySequentialOneToOne($keys, $values),
        ];

        return $this->generateCollectionCasesOneToOne($collections, $values, $keys);
    }

    public function dataProviderManyToMany()
    {
        $keys = $this->generateArrayOfObjects(self::$size);
        $values = $this->generateArrayOfObjects(self::$size);

        $collections = [
            new ArraySequentialOneToOne($keys, $values),
        ];

        return $this->generateCollectionCasesManyToMany($collections, $values, $keys);
    }

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
        $this->assertSequentialEntry($key, $value, $offset, $c->itemOfValue($key));
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
        $this->assertSequentialEntry($key, $value, $offset, $c->itemOfKey($value));
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
