<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\EntryItem;
use ProjxIO\Collections\TestCase;

class FromManyToManyTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param FromManyToMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetsOfEntry(FromManyToMany $collection, $v, $ks, $k, $vs)
    {
        $expect = array_intersect(array_keys($ks[$v[0]]), array_keys($vs[$k[0]]));
        $actual = $collection->offsetsOfEntry($k[0], $v[0]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromManyToMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetsOfItem(FromManyToMany $collection, $v, $ks, $k, $vs)
    {
        $expect = array_intersect(array_keys($ks[$v[0]]), array_keys($vs[$k[0]]));
        $actual = $collection->offsetsOfItem(new EntryItem($k[0], $v[0]));
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromManyToMany $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetsOfItems(FromManyToMany $collection, $v, $ks, $k, $vs)
    {
        $expect = [
            array_intersect(array_keys($ks[$v[0]]), array_keys($vs[$k[0]])),
            array_intersect(array_keys($ks[$v[1]]), array_keys($vs[$k[1]])),
        ];
        $actual = $collection->offsetsOfItems([
            new EntryItem($k[0], $v[0]),
            new EntryItem($k[1], $v[1]),
        ]);
        $this->assertEquals($expect, $actual);
    }
}
