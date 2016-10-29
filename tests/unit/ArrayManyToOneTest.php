<?php

namespace ProjxIO\Collections;

class ArrayManyToOneTest extends TestCase
{
    public function testConstructorEmpty()
    {
        new ArrayManyToOne([]);
    }

    public function testConstructor()
    {
        new ArrayManyToOne([new EntryItem('A', 'X')]);
    }
}
