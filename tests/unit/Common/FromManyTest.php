<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

/**
 * @dataProvider
 */
class FromManyTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param FromMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetsOfValue(FromMany $collection, $v, $ks, $k, $vs)
    {
        $expect = array_keys($ks[$v[0]]);
        $actual = $collection->offsetsOfValue($v[0]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetsOfValues(FromMany $collection, $v, $ks, $k, $vs)
    {
        $expect = [array_keys($ks[$v[0]]), array_keys($ks[$v[1]])];
        $actual = $collection->offsetsOfValues([$v[0], $v[1]]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testKeysOfValue(FromMany $collection, $v, $ks, $k, $vs)
    {
        $expect = array_values($ks[$v[0]]);
        $actual = $collection->keysOfValue($v[0]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testKeysOfValues(FromMany $collection, $v, $ks, $k, $vs)
    {
        $expect = [array_values($ks[$v[0]]), array_values($ks[$v[1]])];
        $actual = $collection->keysOfValues([$v[0], $v[1]]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testItemsOfValue(FromMany $collection, $v, $ks, $k, $vs)
    {
        $keys = array_values($ks[$v[0]]);
        $values = [$v[0], $v[0]];
        $actual = $collection->itemsOfValue($v[0]);
        $this->assertEntries($keys, $values, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromMany $collection
     * @param mixed[] $values
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testItemsOfValues(FromMany $collection, $values, $ks, $k, $vs)
    {
        $keys = [array_values($ks[$values[0]]), array_values($ks[$values[1]])];
        $values = [[$values[0], $values[0]], [$values[1], $values[1]]];
        $actual = $collection->itemsOfValues([$values[0], $values[1]]);
        $this->assertEntriesList($keys, $values, $actual);
    }
}
