<?php

namespace ProjxIO\Collections;

class ArrayManyToOneTest extends TestCase
{
    public function testConstructorEmpty()
    {
        $this->assertInstanceOf(ArrayManyToOne::class, new ArrayManyToOne([]));
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(ArrayManyToOne::class, new ArrayManyToOne([new EntryItem('A', 'X')]));
    }
}
