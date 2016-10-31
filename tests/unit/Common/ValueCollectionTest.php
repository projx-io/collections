<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class ValueCollectionTest extends TestCase
{

    /**
     * @dataProvider collectionProviderTest
     * @param ValueCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testContainsValue(ValueCollection $collection, $v, $vs, $k, $ks)
    {
        $actual = $collection->containsValue($v[0]);
        $this->assertTrue($actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ValueCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testContainsValueFalse(ValueCollection $collection, $v, $vs, $k, $ks)
    {
        $actual = $collection->containsValue('NN');
        $this->assertFalse($actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ValueCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testValueOfOffset(ValueCollection $collection, $v, $vs, $k, $ks)
    {
        $expect = $v[1];
        $actual = $collection->valueOfOffset(1);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ValueCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testValueOfOffsets(ValueCollection $collection, $v, $vs, $k, $ks)
    {
        $expect = [$v[1], $v[2]];
        $actual = $collection->valueOfOffsets([1, 2]);
        $this->assertEquals($expect, $actual);
    }
}
