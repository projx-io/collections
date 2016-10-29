<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\EntryItem;
use ProjxIO\Collections\TestCase;

class ToOneTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param ToOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetOfKey(ToOne $collection, $v, $ks, $k, $vs)
    {
        $expect = array_keys($vs[$k[0]])[0];
        $actual = $collection->offsetOfKey($k[0]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetOfKeys(ToOne $collection, $v, $ks, $k, $vs)
    {
        $expect = [array_keys($vs[$k[0]])[0], array_keys($vs[$k[1]])[0]];
        $actual = $collection->offsetOfKeys([$k[0], $k[1]]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testValueOfKey(ToOne $collection, $v, $ks, $k, $vs)
    {
        $expect = array_values($vs[$k[0]])[0];
        $actual = $collection->valueOfKey($k[0]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testValueOfKeys(ToOne $collection, $v, $ks, $k, $vs)
    {
        $expect = [array_values($vs[$k[0]])[0], array_values($vs[$k[1]])[0]];
        $actual = $collection->valueOfKeys([$k[0], $k[1]]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testItemOfKey(ToOne $collection, $v, $ks, $k, $vs)
    {
        $key = $k[0];
        $value = $vs[$k[0]][0];
        $actual = $collection->itemOfKey($k[0]);
        $this->assertEntry($key, $value, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testItemOfKeys(ToOne $collection, $v, $ks, $k, $vs)
    {
        $key = [$k[0], $k[1]];
        $value = [array_values($vs[$k[0]])[0], array_values($vs[$k[1]])[0]];
        $actual = $collection->itemOfKeys([$k[0], $k[1]]);
        $this->assertEntries($key, $value, $actual);
    }
}
