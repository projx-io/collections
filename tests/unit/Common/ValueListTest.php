<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class ValueListTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param ValueList $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetsOfValue(ValueList $collection, $v, $vs, $k, $ks)
    {
        $expect = array_keys($ks[$v[0]]);
        $actual = $collection->offsetsOfValue($v[0]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ValueList $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetsOfValues(ValueList $collection, $v, $vs, $k, $ks)
    {
        $expect = [array_keys($ks[$v[0]]), array_keys($ks[$v[1]])];
        $actual = $collection->offsetsOfValues([$v[0], $v[1]]);
        $this->assertEquals($expect, $actual);
    }
}
