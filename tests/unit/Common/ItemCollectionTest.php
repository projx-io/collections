<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\EntryItem;
use ProjxIO\Collections\TestCase;

class ItemCollectionTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param ItemCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testContainsKey(ItemCollection $collection, $v, $ks, $k, $vs)
    {
        $actual = $collection->containsKey($k[0]);
        $this->assertTrue($actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testContainsKeyFalse(ItemCollection $collection, $v, $ks, $k, $vs)
    {
        $actual = $collection->containsKey('MM');
        $this->assertFalse($actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testContainsValue(ItemCollection $collection, $v, $ks, $k, $vs)
    {
        $actual = $collection->containsValue($v[0]);
        $this->assertTrue($actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testContainsValueFalse(ItemCollection $collection, $v, $ks, $k, $vs)
    {
        $actual = $collection->containsValue('NN');
        $this->assertFalse($actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testContainsEntry(ItemCollection $collection, $v, $ks, $k, $vs)
    {
        $actual = $collection->containsEntry($k[0], $v[0]);
        $this->assertTrue($actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testContainsEntryFalse(ItemCollection $collection, $v, $ks, $k, $vs)
    {
        $actual = $collection->containsEntry('MM', 'NN');
        $this->assertFalse($actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testContainsItem(ItemCollection $collection, $v, $ks, $k, $vs)
    {
        $item = new EntryItem($k[0], $v[0]);
        $actual = $collection->containsItem($item);
        $this->assertTrue($actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testContainsItemFalse(ItemCollection $collection, $v, $ks, $k, $vs)
    {
        $item = new EntryItem('MM', 'NN');
        $actual = $collection->containsItem($item);
        $this->assertFalse($actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testContainsItems(ItemCollection $collection, $v, $ks, $k, $vs, $i)
    {
        $items = [
            new EntryItem($k[0], $v[0]),
            new EntryItem($k[2], $v[2]),
        ];
        $actual = $collection->containsItems($items);
        $this->assertTrue($actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testContainsItemsFalse(ItemCollection $collection, $v, $ks, $k, $vs, $i)
    {
        $items = [
            new EntryItem($k[0], $v[0]),
            new EntryItem('MM', 'NN'),
        ];
        $actual = $collection->containsItems($items);
        $this->assertFalse($actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testKeys(ItemCollection $collection, $v, $ks, $k, $vs)
    {
        $expect = $k;
        $actual = $collection->keys();
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testValues(ItemCollection $collection, $v, $ks, $k, $vs)
    {
        $expect = $v;
        $actual = $collection->values();
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     * @param Entry[] $i
     */
    public function testItems(ItemCollection $collection, $v, $ks, $k, $vs, $i)
    {
        $expect = $i;
        $actual = $collection->items();
        $this->assertItems($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testValueOfOffset(ItemCollection $collection, $v, $ks, $k, $vs)
    {
        $expect = $v[1];
        $actual = $collection->valueOfOffset(1);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testValueOfOffsets(ItemCollection $collection, $v, $ks, $k, $vs)
    {
        $expect = [$v[1], $v[2]];
        $actual = $collection->valueOfOffsets([1, 2]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testKeyOfOffset(ItemCollection $collection, $v, $ks, $k, $vs)
    {
        $expect = $k[1];
        $actual = $collection->keyOfOffset(1);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testKeyOfOffsets(ItemCollection $collection, $v, $ks, $k, $vs)
    {
        $expect = [$k[1], $k[2]];
        $actual = $collection->keyOfOffsets([1, 2]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testItemOfOffset(ItemCollection $collection, $v, $ks, $k, $vs)
    {
        $key = $k[1];
        $value = $v[1];
        $actual = $collection->itemOfOffset(1);
        $this->assertEntry($key, $value, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ItemCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testItemOfOffsets(ItemCollection $collection, $v, $ks, $k, $vs)
    {
        $keys = [$k[1], $k[2]];
        $values = [$v[1], $v[2]];
        $actual = $collection->itemOfOffsets([1, 2]);
        $this->assertEntries($keys, $values, $actual);
    }
}
