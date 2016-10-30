<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\EntryItem;
use ProjxIO\Collections\TestCase;

class MutableFromToOneTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param MutableFromToOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testRemoveEntry(MutableFromToOne $collection, $v, $ks, $k, $vs)
    {
        $this->assertTrue($collection->containsEntry($k[0], $v[0]));
        $collection->removeEntry($k[0], $v[0]);
        $this->assertFalse($collection->containsEntry($k[0], $v[0]));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param MutableFromToOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testRemoveItem(MutableFromToOne $collection, $v, $ks, $k, $vs)
    {
        $this->assertTrue($collection->containsEntry($k[0], $v[0]));
        $collection->removeItem(new EntryItem($k[0], $v[0]));
        $this->assertFalse($collection->containsEntry($k[0], $v[0]));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param MutableFromToOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testRemoveItems(MutableFromToOne $collection, $v, $ks, $k, $vs)
    {
        $this->assertTrue($collection->containsEntry($k[0], $v[0]));
        $this->assertTrue($collection->containsEntry($k[2], $v[2]));
        $collection->removeItems([
            new EntryItem($k[0], $v[0]),
            new EntryItem($k[2], $v[2]),
        ]);
        $this->assertFalse($collection->containsEntry($k[0], $v[0]));
        $this->assertFalse($collection->containsEntry($k[2], $v[2]));
    }
}
