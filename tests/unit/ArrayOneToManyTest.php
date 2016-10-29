<?php

namespace ProjxIO\Collections;

class ArrayOneToManyTest extends TestCase
{
    public function testConstructorEmpty()
    {
        new ArrayOneToMany([]);
    }

    public function testConstructor()
    {
        new ArrayOneToMany([new EntryItem('A', 'X')]);
    }
}
