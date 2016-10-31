<?php

namespace ProjxIO\Collections;

class ArrayListTest extends TestCase
{
    public function testConstructorEmpty()
    {
        new ArrayList([]);
    }

    public function testConstructor()
    {
        new ArrayList(['a']);
    }
}
