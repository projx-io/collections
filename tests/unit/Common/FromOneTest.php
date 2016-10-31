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
    public function testKeyOfValue(FromOne $collection, $v, $vs, $k, $ks)
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
    public function testKeyOfValues(FromOne $collection, $v, $vs, $k, $ks)
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
    public function testItemOfValue(FromOne $collection, $v, $vs, $k, $ks)
    {
        $keys = array_values($ks[$v[0]])[0];
        $values = $v[0];
        $actual = $collection->itemOfValue($v[0]);
        $this->assertEntry($keys, $values, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testItemOfValues(FromOne $collection, $v, $vs, $k, $ks)
    {
        $keys = [array_values($ks[$v[0]])[0], array_values($ks[$v[1]])[0]];
        $values = [$v[0], $v[1]];
        $actual = $collection->itemOfValues([$v[0], $v[1]]);
        $this->assertEntries($keys, $values, $actual);
    }
}
