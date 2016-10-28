<?php

namespace ProjxIO\Collections;

class ArrayManyToManyTest extends TestCase
{
    public function testConstructorEmpty()
    {
        new ArrayManyToMany([]);
    }

    public function testConstructor()
    {
        new ArrayManyToMany([new EntryItem('A', 'X')]);
    }
}
