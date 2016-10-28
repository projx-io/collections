<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\ArrayManyToMany;
use ProjxIO\Collections\TestCase;

class ToManyTest extends TestCase
{
    public function testOffsetsOfKey()
    {
        $collection = new ArrayManyToMany([
            new EntryItem('A', 'X'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'Z'),
            new EntryItem('D', 'X'),
            new EntryItem('A', 'Y'),
            new EntryItem('B', 'Z'),
        ]);

        $this->assertEquals([0, 4], $collection->offsetsOfKey('A'));
    }

    public function testOffsetsOfKeys()
    {
        $collection = new ArrayManyToMany([
            new EntryItem('A', 'X'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'Z'),
            new EntryItem('D', 'X'),
            new EntryItem('A', 'Y'),
            new EntryItem('B', 'Z'),
        ]);

        $this->assertEquals([[0, 4], [2]], $collection->offsetsOfKeys(['A', 'C']));
    }

    public function testValuesOfKey()
    {
        $collection = new ArrayManyToMany([
            new EntryItem('A', 'X'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'Z'),
            new EntryItem('D', 'X'),
            new EntryItem('A', 'Y'),
            new EntryItem('B', 'Z'),
        ]);

        $this->assertEquals(['X', 'Y'], $collection->valuesOfKey('A'));
    }

    public function testValuesOfKeys()
    {
        $collection = new ArrayManyToMany([
            new EntryItem('A', 'X'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'Z'),
            new EntryItem('D', 'X'),
            new EntryItem('A', 'Y'),
            new EntryItem('B', 'Z'),
        ]);

        $this->assertEquals([['X', 'Y'], ['X']], $collection->valuesOfKeys(['A', 'D']));
    }

    public function testItemsOfKey()
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

        $this->assertItems($items, $collection->itemsOfKey('A'));
    }

    public function testItemsOfKeys()
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
                new EntryItem('A', 'Y'),
            ],
            [
                new EntryItem('D', 'X'),
            ],
        ];

        $this->assertItemsList($items, $collection->itemsOfKeys(['A', 'D']));
    }
}
