<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\ArrayManyToMany;
use ProjxIO\Collections\TestCase;

class FromToOneManyTest extends TestCase
{
    public function testValueOfOffset()
    {
        $collection = new ArrayManyToMany([
            new EntryItem('A', 'X'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'Z'),
            new EntryItem('D', 'X'),
            new EntryItem('A', 'Y'),
            new EntryItem('B', 'Z'),
        ]);

        $this->assertEquals('Y', $collection->valueOfOffset(4));
    }

    public function testValueOfOffsets()
    {
        $collection = new ArrayManyToMany([
            new EntryItem('A', 'X'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'Z'),
            new EntryItem('D', 'X'),
            new EntryItem('A', 'Y'),
            new EntryItem('B', 'Z'),
        ]);

        $this->assertEquals(['Y', 'X'], $collection->valueOfOffsets([4, 0]));
    }

    public function testKeyOfOffset()
    {
        $collection = new ArrayManyToMany([
            new EntryItem('A', 'X'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'Z'),
            new EntryItem('D', 'X'),
            new EntryItem('A', 'Y'),
            new EntryItem('B', 'Z'),
        ]);

        $this->assertEquals('A', $collection->keyOfOffset(4));
    }

    public function testKeyOfOffsets()
    {
        $collection = new ArrayManyToMany([
            new EntryItem('A', 'X'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'Z'),
            new EntryItem('D', 'X'),
            new EntryItem('A', 'Y'),
            new EntryItem('B', 'Z'),
        ]);

        $this->assertEquals(['D', 'A'], $collection->keyOfOffsets([3, 0]));
    }

    public function testItemOfOffset()
    {
        $collection = new ArrayManyToMany([
            new EntryItem('A', 'X'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'Z'),
            new EntryItem('D', 'X'),
            new EntryItem('A', 'Y'),
            new EntryItem('B', 'Z'),
        ]);

        $this->assertItem(new EntryItem('A', 'Y'), $collection->itemOfOffset(4));
    }

    public function testItemOfOffsets()
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

        $this->assertItems($items, $collection->itemOfOffsets([0, 4]));
    }
}
