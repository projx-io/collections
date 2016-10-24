<?php

namespace ProjxIO\Collections;

class ArraySequentialOneToOneTest extends TestCase
{
    public function dataProvider()
    {
        $keys = $this->combinations($this->generateArrayOfObjects(self::$size));
        $values = $this->combinations($this->generateArrayOfObjects(self::$size));

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
        $a = new ArraySequentialOneToOne($keys, $values);
        $offsets = array_keys($keys);
        $this->assertEntries($keys, $values, $a->itemsAtOffsets($offsets));
    }
}
