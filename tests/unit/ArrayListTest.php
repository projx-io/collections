<?php

namespace ProjxIO\Collections;

class ArrayListTest extends TestCase
{
    public function testConstructorEmpty()
    {
        $this->assertInstanceOf(ArrayList::class, new ArrayList([]));
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(ArrayList::class, new ArrayList(['a']));
    }
}
