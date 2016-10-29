<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\EntryItem;
use ProjxIO\Collections\TestCase;

class FromToOneTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param FromToOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetOfEntry(FromToOne $collection, $v, $ks, $k, $vs)
    {
        $expect = array_keys($ks[$v[0]])[0];
        $actual = $collection->offsetOfEntry($k[0], $v[0]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromToOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetOfItem(FromToOne $collection, $v, $ks, $k, $vs)
    {
        $item = new EntryItem($k[0], $v[0]);
        $expect = array_keys($ks[$v[0]])[0];
        $actual = $collection->offsetOfItem($item);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromToOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetOfItems(FromToOne $collection, $v, $ks, $k, $vs)
    {
        $items = [
            new EntryItem($k[0], $v[0]),
            new EntryItem($k[1], $v[1]),
        ];
        $expect = [array_keys($ks[$v[0]])[0], array_keys($ks[$v[1]])[0]];
        $actual = $collection->offsetOfItems($items);
        $this->assertEquals($expect, $actual);
    }
}
