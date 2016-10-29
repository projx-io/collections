<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\EntryItem;
use ProjxIO\Collections\TestCase;

class ToOneTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param ToOne $collection
     */
    public function testOffsetOfKey(ToOne $collection)
    {
        $this->assertEquals(2, $collection->offsetOfKey('C'));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToOne $collection
     */
    public function testOffsetOfKeys(ToOne $collection)
    {
        $this->assertEquals([2, 4], $collection->offsetOfKeys(['C', 'E']));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToOne $collection
     */
    public function testValueOfKey(ToOne $collection)
    {
        $this->assertEquals('Z', $collection->valueOfKey('C'));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToOne $collection
     */
    public function testValueOfKeys(ToOne $collection)
    {
        $this->assertEquals(['Z', 'Y'], $collection->valueOfKeys(['C', 'E']));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToOne $collection
     */
    public function testItemOfKey(ToOne $collection)
    {
        $this->assertItem(new EntryItem('C', 'Z'), $collection->itemOfKey('C'));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ToOne $collection
     */
    public function testItemOfKeys(ToOne $collection)
    {
        $items = [
            new EntryItem('C', 'Z'),
            new EntryItem('E', 'Y'),
        ];

        $this->assertItems($items, $collection->itemOfKeys(['C', 'E']));
    }
}
