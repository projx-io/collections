<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

/**
 * @dataProvider
 */
class FromOneTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param FromOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetOfValue(FromOne $collection, $v, $ks, $k, $vs)
    {
        $expect = array_keys($ks[$v[0]])[0];
        $actual = $collection->offsetOfValue($v[0]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetOfValues(FromOne $collection, $v, $ks, $k, $vs)
    {
        $expect = [array_keys($ks[$v[0]])[0], array_keys($ks[$v[1]])[0]];
        $actual = $collection->offsetOfValues([$v[0], $v[1]]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testKeyOfValue(FromOne $collection, $v, $ks, $k, $vs)
    {
        $expect = array_values($ks[$v[0]])[0];
        $actual = $collection->keyOfValue($v[0]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testKeyOfValues(FromOne $collection, $v, $ks, $k, $vs)
    {
        $expect = [array_values($ks[$v[0]])[0], array_values($ks[$v[1]])[0]];
        $actual = $collection->keyOfValues([$v[0], $v[1]]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testItemOfValue(FromOne $collection, $v, $ks, $k, $vs)
    {
        $keys = array_values($ks[$v[0]])[0];
        $values = $v[0];
        $actual = $collection->itemOfValue($v[0]);
        $this->assertEntry($keys, $values, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromOne $collection
     * @param mixed[] $values
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testItemOfValues(FromOne $collection, $values, $ks, $k, $vs)
    {
        $keys = [array_values($ks[$values[0]])[0], array_values($ks[$values[1]])[0]];
        $values = [$values[0], $values[1]];
        $actual = $collection->itemOfValues([$values[0], $values[1]]);
        $this->assertEntries($keys, $values, $actual);
    }
}
