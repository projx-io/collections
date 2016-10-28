<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\ArrayManyToMany;
use ProjxIO\Collections\TestCase;

class FromToManyTest extends TestCase
{
    public function testOffsetsOfEntry()
    {
        $collection = new ArrayManyToMany([
            new EntryItem('A', 'X'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'Z'),
            new EntryItem('D', 'X'),
            new EntryItem('A', 'Y'),
            new EntryItem('B', 'Z'),
        ]);

        $this->assertEquals([4], $collection->offsetsOfEntry('A', 'Y'));
    }

    public function testOffsetsOfItem()
    {
        $collection = new ArrayManyToMany([
            new EntryItem('A', 'X'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'Z'),
            new EntryItem('D', 'X'),
            new EntryItem('A', 'Y'),
            new EntryItem('B', 'Z'),
        ]);

        $this->assertEquals([4], $collection->offsetsOfItem(new EntryItem('A', 'Y')));
    }

    public function testOffsetsOfItems()
    {
        $collection = new ArrayManyToMany([
            new EntryItem('A', 'X'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'Z'),
            new EntryItem('D', 'X'),
            new EntryItem('A', 'Y'),
            new EntryItem('B', 'Z'),
        ]);

        $items = [
            new EntryItem('A', 'X'),
            new EntryItem('A', 'Y'),
        ];

        $this->assertEquals([[0], [4]], $collection->offsetsOfItems($items));
    }
}
