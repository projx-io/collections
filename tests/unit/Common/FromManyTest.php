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
    public function testKeysOfValue(FromMany $collection, $v, $vs, $k, $ks)
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
    public function testKeysOfValues(FromMany $collection, $v, $vs, $k, $ks)
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
    public function testItemsOfValue(FromMany $collection, $v, $vs, $k, $ks)
    {
        $keys = array_values($ks[$v[0]]);
        $values = [$v[0], $v[0]];
        $actual = $collection->itemsOfValue($v[0]);
        $this->assertEntries($keys, $values, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testItemsOfValues(FromMany $collection, $v, $vs, $k, $ks)
    {
        $keys = [array_values($ks[$v[0]]), array_values($ks[$v[1]])];
        $values = [[$v[0], $v[0]], [$v[1], $v[1]]];
        $actual = $collection->itemsOfValues([$v[0], $v[1]]);
        $this->assertEntriesList($keys, $values, $actual);
    }
}
