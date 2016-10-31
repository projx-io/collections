<?php

namespace ProjxIO\Collections;

class ArrayOneToManyTest extends TestCase
{
    public function testConstructorEmpty()
    {
        $this->assertInstanceOf(ArrayOneToMany::class, new ArrayOneToMany([]));
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(ArrayOneToMany::class, new ArrayOneToMany([new EntryItem('A', 'X')]));
    }
}
