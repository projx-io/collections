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
    public function testRemoveOffset(MutableFromToOne $collection, $v, $ks, $k, $vs)
    {
        $this->assertTrue($collection->containsEntry($k[0], $v[0]));
        $collection->removeOffset(0);
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
    public function testRemoveOffsets(MutableFromToOne $collection, $v, $ks, $k, $vs)
    {
        $this->assertTrue($collection->containsEntry($k[0], $v[0]));
        $this->assertTrue($collection->containsEntry($k[2], $v[2]));
        $collection->removeOffsets([0, 2]);
        $this->assertFalse($collection->containsEntry($k[0], $v[0]));
        $this->assertFalse($collection->containsEntry($k[2], $v[2]));
    }

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

    /**
     * @dataProvider collectionProviderTest
     * @param MutableFromToOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testRemoveValue(MutableFromToOne $collection, $v, $ks, $k, $vs)
    {
        $this->assertTrue($collection->containsValue($v[0]));
        $collection->removeValue($v[0]);
        $this->assertFalse($collection->containsValue($v[0]));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param MutableFromToOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testRemoveValues(MutableFromToOne $collection, $v, $ks, $k, $vs)
    {
        $this->assertTrue($collection->containsValue($v[0]));
        $this->assertTrue($collection->containsValue($v[2]));
        $collection->removeValues([$v[0], $v[2]]);
        $this->assertFalse($collection->containsValue($v[0]));
        $this->assertFalse($collection->containsValue($v[2]));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param MutableFromToOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testRemoveKey(MutableFromToOne $collection, $v, $ks, $k, $vs)
    {
        $this->assertTrue($collection->containsKey($k[0]));
        $collection->removeKey($k[0]);
        $this->assertFalse($collection->containsKey($k[0]));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param MutableFromToOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testRemoveKeys(MutableFromToOne $collection, $v, $ks, $k, $vs)
    {
        $this->assertTrue($collection->containsKey($k[0]));
        $this->assertTrue($collection->containsKey($k[2]));
        $collection->removeKeys([$k[0], $k[2]]);
        $this->assertFalse($collection->containsKey($k[0]));
        $this->assertFalse($collection->containsKey($k[2]));
    }
}
