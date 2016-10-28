<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class ToManyTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param ToMany $collection
     */
    public function testOffsetsOfKey(ToMany $collection)
    {
        $this->assertEquals([0, 4], $collection->offsetsOfKey('A'));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToMany $collection
     */
    public function testOffsetsOfKeys(ToMany $collection)
    {
        $this->assertEquals([[0, 4], [2]], $collection->offsetsOfKeys(['A', 'C']));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToMany $collection
     */
    public function testValuesOfKey(ToMany $collection)
    {
        $this->assertEquals(['X', 'Y'], $collection->valuesOfKey('A'));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToMany $collection
     */
    public function testValuesOfKeys(ToMany $collection)
    {
        $this->assertEquals([['X', 'Y'], ['X']], $collection->valuesOfKeys(['A', 'D']));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToMany $collection
     */
    public function testItemsOfKey(ToMany $collection)
    {
        $items = [
            new EntryItem('A', 'X'),
            new EntryItem('A', 'Y'),
        ];

        $this->assertItems($items, $collection->itemsOfKey('A'));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToMany $collection
     */
    public function testItemsOfKeys(ToMany $collection)
    {
        $items = [
            [
                new EntryItem('A', 'X'),
                new EntryItem('A', 'Y'),
            ],
            [
                new EntryItem('D', 'X'),
            ],
        ];

        $this->assertItemsList($items, $collection->itemsOfKeys(['A', 'D']));
    }
}
