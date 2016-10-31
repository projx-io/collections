<?php

namespace ProjxIO\Collections;

class ArraySetTest extends TestCase
{
    public function testConstructorEmpty()
    {
        $this->assertInstanceOf(ArraySet::class, new ArraySet([]));
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(ArraySet::class, new ArraySet(['a']));
    }
}
