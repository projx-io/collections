<?php

namespace ProjxIO\Collections;

class ArrayManyToManyTest extends TestCase
{
    public function testConstructorEmpty()
    {
        $this->assertInstanceOf(ArrayManyToMany::class, new ArrayManyToMany([]));
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(ArrayManyToMany::class, new ArrayManyToMany([new EntryItem('A', 'X')]));
    }
}
