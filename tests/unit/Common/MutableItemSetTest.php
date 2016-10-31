<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\EntryItem;
use ProjxIO\Collections\TestCase;

class MutableItemSetTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param MutableItemSet $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testPutEntry(MutableItemSet $collection, $v, $ks, $k, $vs)
    {
        $key = 'MM';
        $value = 'NN';
        $this->assertFalse($collection->containsEntry($key, $value));
        $collection->putEntry($key, $value);
        $this->assertTrue($collection->containsEntry($key, $value));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param MutableItemSet $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testPutItem(MutableItemSet $collection, $v, $ks, $k, $vs)
    {
        $key = 'MM';
        $value = 'NN';
        $item = new EntryItem($key, $value);
        $this->assertFalse($collection->containsEntry($key, $value));
        $collection->putItem($item);
        $this->assertTrue($collection->containsEntry($key, $value));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param MutableItemSet $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testPutItems(MutableItemSet $collection, $v, $ks, $k, $vs)
    {
        $items = [
            new EntryItem('MM', 'NN'),
            new EntryItem('OO', 'PP'),
        ];
        $this->assertFalse($collection->containsItems($items));
        $collection->putItems($items);
        $this->assertTrue($collection->containsItems($items));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param MutableItemSet $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testRestrictions(MutableItemSet $collection, $v, $ks, $k, $vs)
    {
        $a = new EntryItem('MM', 'NN');
        $b = new EntryItem('OO', 'PP');
        $c = new EntryItem('MM', 'PP');
        $collection->putItem($a);
        $collection->putItem($b);
        $collection->putItem($c);
        $this->assertTrue($collection->containsItem($c));
        $this->assertFalse($collection->containsItems([$a, $b]));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param MutableItemSet $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testAddDuplicate(MutableItemSet $collection, $v, $ks, $k, $vs)
    {
        $collection->putEntry('AA', 'ZZ');
        $expect = count($collection->items());
        $collection->putEntry('AA', 'ZZ');
        $this->assertEquals($expect, count($collection->items()));
    }
}
