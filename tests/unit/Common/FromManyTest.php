<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class FromManyTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param FromMany $collection
     */
    public function testOffsetsOfValue(FromMany $collection)
    {
        $this->assertEquals([0, 3], $collection->offsetsOfValue('X'));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromMany $collection
     */
    public function testOffsetsOfValues(FromMany $collection)
    {
        $this->assertEquals([[0, 3], [2, 5]], $collection->offsetsOfValues(['X', 'Z']));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromMany $collection
     */
    public function testKeysOfValue(FromMany $collection)
    {
        $this->assertEquals(['A', 'D'], $collection->keysOfValue('X'));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromMany $collection
     */
    public function testKeysOfValues(FromMany $collection)
    {
        $this->assertEquals([['A', 'D'], ['C', 'B']], $collection->keysOfValues(['X', 'Z']));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromMany $collection
     */
    public function testItemsOfValue(FromMany $collection)
    {
        $items = [
            new EntryItem('A', 'X'),
            new EntryItem('D', 'X'),
        ];

        $this->assertItems($items, $collection->itemsOfValue('X'));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromMany $collection
     */
    public function testItemsOfValues(FromMany $collection)
    {
        $items = [
            [
                new EntryItem('A', 'X'),
                new EntryItem('D', 'X'),
            ],
            [
                new EntryItem('C', 'Z'),
                new EntryItem('B', 'Z'),
            ],
        ];

        $this->assertItemsList($items, $collection->itemsOfValues(['X', 'Z']));
    }
}
