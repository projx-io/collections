<?php

namespace ProjxIO\Collections;

class ArrayOneToOneTest extends TestCase
{
    public function testConstructorEmpty()
    {
        $this->assertInstanceOf(ArrayOneToOne::class, new ArrayOneToOne([]));
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(ArrayOneToOne::class, new ArrayOneToOne([new EntryItem('A', 'X')]));
    }
}
