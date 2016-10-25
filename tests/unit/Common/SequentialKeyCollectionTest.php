<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class SequentialKeyCollectionTest extends TestCase
{
    /**
     * @dataProvider dataProviderOneToOne
     * @param SequentialKeyCollection $c
     * @param int $offset
     * @param mixed $value
     * @param mixed $key
     */
    public function testContainsKey(SequentialKeyCollection $c, $offset, $value, $key)
    {
        $this->assertTrue($c->containsKey($key));
    }

    /**
     * @dataProvider dataProviderOneToOne
     * @param SequentialKeyCollection $c
     * @param int $offset
     * @param mixed $value
     * @param mixed $key
     */
    public function testNotContainsKey(SequentialKeyCollection $c, $offset, $value, $key)
    {
        $this->assertFalse($c->containsKey('no value here'));
    }

    /**
     * @dataProvider dataProviderOneToOne
     * @param SequentialKeyCollection $c
     * @param int $offset
     * @param mixed $value
     * @param mixed $key
     */
    public function testKeyAtOffset(SequentialKeyCollection $c, $offset, $value, $key)
    {
        $this->assertEquals($key, $c->keyAtOffset($offset));
    }

    /**
     * @dataProvider dataProviderManyToMany
     * @param SequentialKeyCollection $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     */
    public function testKeysAtOffsets(SequentialKeyCollection $c, $offsets, $values, $keys)
    {
        $this->assertEquals($keys, $c->keysAtOffsets($offsets));
    }

    /**
     * @dataProvider dataProviderManyToMany
     * @param SequentialKeyCollection $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     */
    public function testOffsetsOfKeys(SequentialKeyCollection $c, $offsets, $values, $keys)
    {
        $this->assertEquals($offsets, $c->offsetsOfKeys($keys));
    }
}
