<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class FromToOneManyTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param FromToOneMany $collection
     */
    public function testValueOfOffset(FromToOneMany $collection)
    {
        $this->assertEquals('Y', $collection->valueOfOffset(4));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromToOneMany $collection
     */
    public function testValueOfOffsets(FromToOneMany $collection)
    {
        $this->assertEquals(['Y', 'X'], $collection->valueOfOffsets([4, 0]));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromToOneMany $collection
     */
    public function testKeyOfOffset(FromToOneMany $collection)
    {
        $this->assertEquals('A', $collection->keyOfOffset(4));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromToOneMany $collection
     */
    public function testKeyOfOffsets(FromToOneMany $collection)
    {
        $this->assertEquals(['D', 'A'], $collection->keyOfOffsets([3, 0]));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromToOneMany $collection
     */
    public function testItemOfOffset(FromToOneMany $collection)
    {
        $this->assertItem(new EntryItem('A', 'Y'), $collection->itemOfOffset(4));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param FromToOneMany $collection
     */
    public function testItemOfOffsets(FromToOneMany $collection)
    {
        $items = [
            new EntryItem('A', 'X'),
            new EntryItem('A', 'Y'),
        ];

        $this->assertItems($items, $collection->itemOfOffsets([0, 4]));
    }
}
