<?php

namespace ProjxIO\Collections;

class ArrayOneToOneTest extends TestCase
{
    public function testConstructorEmpty()
    {
        new ArrayOneToOne([]);
    }

    public function testConstructor()
    {
        new ArrayOneToOne([new EntryItem('A', 'X')]);
    }
}
