<?php

namespace ProjxIO\Collections;

class ArraySequentialManyToManyTest extends TestCase
{
    public function dataProvider()
    {
        $keys = $this->combinations($this->generateArrayOfObjects(self::SIZE));
        $values = $this->combinations($this->generateArrayOfObjects(self::SIZE));

        return array_map(function ($keys, $values) {
            return [$keys, $values];
        }, $keys, $values);
    }

    /**
     * @dataProvider dataProvider
     * @param mixed[] $values
     * @param mixed[] $keys
     */
    public function testConstructor($keys, $values)
    {
        $a = new ArraySequentialManyToMany($keys, $values);
        $offsets = array_keys($keys);
        $this->assertEntries($keys, $values, $a->itemsAtOffsets($offsets));
    }
}
