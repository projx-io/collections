<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\ManyToMany;
use ProjxIO\Collections\Common\ManyToOne;
use ProjxIO\Collections\Common\OneToMany;
use ProjxIO\Collections\Common\OneToOne;
use ProjxIO\Collections\Common\ValueList;
use ProjxIO\Collections\Common\ValueSet;

class ValueStreamTest extends TestCase
{
    public function testToList()
    {
        $values = ['a', 'b', 'c'];
        $expect = ValueList::class;
        $stream = new ValueStream($values);
        $collection = $stream->toList();
        $this->assertInstanceOf($expect, $collection);
        $this->assertEquals($values, $collection->valueOfOffsets([0, 1, 2]));
    }

    public function testToSet()
    {
        $values = ['a', 'b', 'c'];
        $expect = ValueSet::class;
        $stream = new ValueStream($values);
        $collection = $stream->toSet();
        $this->assertInstanceOf($expect, $collection);
        $this->assertEquals($values, $collection->valueOfOffsets([0, 1, 2]));
    }

    public function testOneToOne()
    {
        $items = [new EntryItem('A', 'a'), new EntryItem('B', 'b'), new EntryItem('C', 'c')];
        $values = ['a', 'b', 'c'];
        $expect = OneToOne::class;
        $stream = new ValueStream($items);
        $collection = $stream->toOneToOne();
        $this->assertInstanceOf($expect, $collection);
        $this->assertEquals($values, $collection->valueOfOffsets([0, 1, 2]));
    }

    public function testOneToMany()
    {
        $items = [new EntryItem('A', 'a'), new EntryItem('B', 'b'), new EntryItem('C', 'c')];
        $values = ['a', 'b', 'c'];
        $expect = OneToMany::class;
        $stream = new ValueStream($items);
        $collection = $stream->toOneToMany();
        $this->assertInstanceOf($expect, $collection);
        $this->assertEquals($values, $collection->valueOfOffsets([0, 1, 2]));
    }

    public function testManyToOne()
    {
        $items = [new EntryItem('A', 'a'), new EntryItem('B', 'b'), new EntryItem('C', 'c')];
        $values = ['a', 'b', 'c'];
        $expect = ManyToOne::class;
        $stream = new ValueStream($items);
        $collection = $stream->toManyToOne();
        $this->assertInstanceOf($expect, $collection);
        $this->assertEquals($values, $collection->valueOfOffsets([0, 1, 2]));
    }

    public function testManyToMany()
    {
        $items = [new EntryItem('A', 'a'), new EntryItem('B', 'b'), new EntryItem('C', 'c')];
        $values = ['a', 'b', 'c'];
        $expect = ManyToMany::class;
        $stream = new ValueStream($items);
        $collection = $stream->toManyToMany();
        $this->assertInstanceOf($expect, $collection);
        $this->assertEquals($values, $collection->valueOfOffsets([0, 1, 2]));
    }

    public function testMap()
    {
        $values = ['a', 'b', 'c'];
        $expect = ['A', 'B', 'C'];
        $stream = new ValueStream($values);
        $actual = $stream->map('strtoupper')->toList()->toArray();
        $this->assertEquals($expect, $actual);
    }

    public function testEach()
    {
        $values = ['a', 'b', 'c'];
        $stream = new ValueStream($values);
        $actual = $stream->each('strtoupper')->toList()->toArray();
        $this->assertEquals($values, $actual);
    }

    public function testFilter()
    {
        $values = ['a', 'b', 'c'];
        $expect = ['a', 'c'];
        $stream = new ValueStream($values);
        $actual = $stream->filter(function ($value) {
            return ord($value) % 2;
        })->toList()->toArray();
        $this->assertEquals($expect, $actual);
    }

    public function testGetIterator()
    {
        $values = ['a', 'b', 'c'];
        $stream = new ValueStream($values);
        $i = 0;
        foreach ($stream as $key => $value) {
            $this->assertEquals($i, $key);
            $this->assertEquals($values[$i], $value);
            $i++;
        }
    }
}
