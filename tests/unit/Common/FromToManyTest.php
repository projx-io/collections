<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class FromToManyTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param FromToMany $collection
     */
    public function testOffsetsOfEntry(FromToMany $collection)
    {
        $this->assertEquals([4], $collection->offsetsOfEntry('A', 'Y'));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromToMany $collection
     */
    public function testOffsetsOfItem(FromToMany $collection)
    {
        $this->assertEquals([4], $collection->offsetsOfItem(new EntryItem('A', 'Y')));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromToMany $collection
     */
    public function testOffsetsOfItems(FromToMany $collection)
    {
        $items = [
            new EntryItem('A', 'X'),
            new EntryItem('A', 'Y'),
        ];

        $this->assertEquals([[0], [4]], $collection->offsetsOfItems($items));
    }
}
