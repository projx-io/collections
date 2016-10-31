<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class ToManyTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param ToMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetsOfKey(ToMany $collection, $v, $vs, $k, $ks)
    {
        $expect = array_keys($vs[$k[0]]);
        $actual = $collection->offsetsOfKey($k[0]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetsOfKeys(ToMany $collection, $v, $vs, $k, $ks)
    {
        $expect = [array_keys($vs[$k[0]]), array_keys($vs[$k[1]])];
        $actual = $collection->offsetsOfKeys([$k[0], $k[1]]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testValuesOfKey(ToMany $collection, $v, $vs, $k, $ks)
    {
        $expect = array_values($vs[$k[0]]);
        $actual = $collection->valuesOfKey($k[0]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testValuesOfKeys(ToMany $collection, $v, $vs, $k, $ks)
    {
        $expect = [array_values($vs[$k[0]]), array_values($vs[$k[1]])];
        $actual = $collection->valuesOfKeys([$k[0], $k[1]]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testItemsOfKey(ToMany $collection, $v, $vs, $k, $ks)
    {
        $values = array_values($vs[$k[0]]);
        $keys = [$k[0], $k[0]];
        $actual = $collection->itemsOfKey($k[0]);
        $this->assertEntries($keys, $values, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testItemsOfKeys(ToMany $collection, $v, $vs, $k, $ks)
    {
        $values = [array_values($vs[$k[0]]), array_values($vs[$k[1]])];
        $keys = [[$k[0], $k[0]], [$k[1], $k[1]]];
        $actual = $collection->itemsOfKeys([$k[0], $k[1]]);
        $this->assertEntriesList($keys, $values, $actual);
    }
}
