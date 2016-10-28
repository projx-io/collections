<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\EntryItem;

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
