<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class SequentialItemCollectionTest extends TestCase
{
    /**
     * @dataProvider dataProviderOneToOne
     * @param SequentialItemCollection $c
     * @param int $offset
     * @param mixed $value
     * @param mixed $key
     * @param SequentialEntry $item
     */
    public function testItemAtOffset(SequentialItemCollection $c, $offset, $value, $key, $item)
    {
        $this->assertSequentialEntry($key, $value, $offset, $c->itemAtOffset($offset));
    }

    /**
     * @dataProvider dataProviderManyToMany
     * @param SequentialItemCollection $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     * @param SequentialEntry[] $items
     */
    public function testItemsAtOffsets(SequentialItemCollection $c, $offsets, $values, $keys, $items)
    {
        $this->assertSequentialEntries($keys, $values, $offsets, $c->itemsAtOffsets($offsets));
    }

    /**
     * @dataProvider dataProviderManyToMany
     * @param SequentialItemCollection $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     * @param SequentialEntry[] $items
     */
    public function testItemsOfKeys(SequentialItemCollection $c, $offsets, $values, $keys, $items)
    {
        $this->assertSequentialEntries($keys, $values, $offsets, $c->itemsOfKeys($keys));
    }

    /**
     * @dataProvider dataProviderManyToMany
     * @param SequentialItemCollection $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     * @param SequentialEntry[] $items
     */
    public function testItemsOfValues(SequentialItemCollection $c, $offsets, $values, $keys, $items)
    {
        $this->assertSequentialEntries($keys, $values, $offsets, $c->itemsOfValues($values));
    }

    /**
     * @dataProvider dataProviderManyToMany
     * @param SequentialItemCollection $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     * @param SequentialEntry[] $items
     */
    public function testOffsetsOfItems(SequentialItemCollection $c, $offsets, $values, $keys, $items)
    {
        $this->assertEquals($offsets, $c->offsetsOfItems($items));
    }
}
