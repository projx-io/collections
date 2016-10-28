<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\ArrayManyToMany;
use ProjxIO\Collections\TestCase;

class FromManyTest extends TestCase
{
    public function testOffsetsOfValue()
    {
        $collection = new ArrayManyToMany([
            new EntryItem('A', 'X'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'Z'),
            new EntryItem('D', 'X'),
            new EntryItem('A', 'Y'),
            new EntryItem('B', 'Z'),
        ]);

//        $this->assertEquals([0, 3], $collection->offsetsOfValue('X'));
    }

    public function testOffsetsOfValues()
    {
        $collection = new ArrayManyToMany([
            new EntryItem('A', 'X'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'Z'),
            new EntryItem('D', 'X'),
            new EntryItem('A', 'Y'),
            new EntryItem('B', 'Z'),
        ]);

//        $this->assertEquals([[0, 3], [2, 5]], $collection->offsetsOfValue(['X', 'Z']));
    }

    public function testKeysOfValue()
    {
        $collection = new ArrayManyToMany([
            new EntryItem('A', 'X'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'Z'),
            new EntryItem('D', 'X'),
            new EntryItem('A', 'Y'),
            new EntryItem('B', 'Z'),
        ]);

//        $this->assertEquals(['A', 'D'], $collection->offsetsOfValue('X'));
    }

    public function testKeysOfValues()
    {
        $collection = new ArrayManyToMany([
            new EntryItem('A', 'X'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'Z'),
            new EntryItem('D', 'X'),
            new EntryItem('A', 'Y'),
            new EntryItem('B', 'Z'),
        ]);

//        $this->assertEquals([['A', 'D'], ['C', 'B']], $collection->offsetsOfValue(['X', 'Z']));
    }

    public function testItemsOfValue()
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
            new EntryItem('D', 'X'),
        ];
//        $this->assertItems($items, $collection->itemsOfValue('X'));
    }

    public function testItemsOfValues()
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
            [
                new EntryItem('A', 'X'),
                new EntryItem('D', 'X'),
            ],
        ];
//        $this->assertItemsList($items, $collection->itemsOfValues(['X', 'Z']));
    }
}
