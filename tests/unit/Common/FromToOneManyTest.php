<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\EntryItem;
use ProjxIO\Collections\TestCase;

class FromToOneManyTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param FromToOneMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testValueOfOffset(FromToOneMany $collection, $v, $ks, $k, $vs)
    {
        $expect = $v[1];
        $actual = $collection->valueOfOffset(1);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromToOneMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testValueOfOffsets(FromToOneMany $collection, $v, $ks, $k, $vs)
    {
        $expect = [$v[1], $v[2]];
        $actual = $collection->valueOfOffsets([1, 2]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromToOneMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testKeyOfOffset(FromToOneMany $collection, $v, $ks, $k, $vs)
    {
        $expect = $k[1];
        $actual = $collection->keyOfOffset(1);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromToOneMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testKeyOfOffsets(FromToOneMany $collection, $v, $ks, $k, $vs)
    {
        $expect = [$k[1], $k[2]];
        $actual = $collection->keyOfOffsets([1, 2]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromToOneMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testItemOfOffset(FromToOneMany $collection, $v, $ks, $k, $vs)
    {
        $key = $k[1];
        $value = $v[1];
        $actual = $collection->itemOfOffset(1);
        $this->assertEntry($key, $value, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromToOneMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testItemOfOffsets(FromToOneMany $collection, $v, $ks, $k, $vs)
    {
        $keys = [$k[1], $k[2]];
        $values = [$v[1], $v[2]];
        $actual = $collection->itemOfOffsets([1, 2]);
        $this->assertEntries($keys, $values, $actual);
    }
}
