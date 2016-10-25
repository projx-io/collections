<?php

namespace ProjxIO\Collections;

class ArraySequentialValueSetTest extends TestCase
{
    public function dataProvider()
    {
        $values = $this->combinations($this->generateArrayOfObjects(self::SIZE));

        return array_map(function ($values) {
            return [$values];
        }, $values);
    }

    /**
     * @dataProvider dataProvider
     * @param mixed[] $values
     * @param mixed[] $keys
     */
    public function testConstructor($values)
    {
        $a = new ArraySequentialValueSet($values);
        $offsets = array_keys($values);
        $this->assertEquals($values, $a->valuesAtOffsets($offsets));
    }
}