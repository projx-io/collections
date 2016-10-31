<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\EntryItem;
use ProjxIO\Collections\TestCase;

class ItemSetTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param ItemSet $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetOfEntry(ItemSet $collection, $v, $vs, $k, $ks)
    {
        $expect = array_keys($ks[$v[0]])[0];
        $actual = $collection->offsetOfEntry($k[0], $v[0]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemSet $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetOfItem(ItemSet $collection, $v, $vs, $k, $ks)
    {
        $item = new EntryItem($k[0], $v[0]);
        $expect = array_keys($ks[$v[0]])[0];
        $actual = $collection->offsetOfItem($item);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemSet $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetOfItems(ItemSet $collection, $v, $vs, $k, $ks)
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
