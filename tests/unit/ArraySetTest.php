<?php

namespace ProjxIO\Collections;

class ArraySetTest extends TestCase
{
    public function testConstructorEmpty()
    {
        new ArraySet([]);
    }

    public function testConstructor()
    {
        new ArraySet(['a']);
    }
}
