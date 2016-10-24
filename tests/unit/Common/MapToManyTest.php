<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class MapToManyTest extends TestCase
{
    /**
     * @dataProvider dataProviderOneToMany
     * @param MapToMany $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed $key
     * @param mixed $items
     */
    public function testItemsOfKey(MapToMany $c, $offsets, $values, $key, $items)
    {
        $this->assertItems($items, $c->itemsOfKey($key));
    }

    /**
     * @dataProvider dataProviderOneToMany
     * @param MapToMany $c
     * @param int $offset
     * @param mixed[] $values
     * @param mixed $key
     */
    public function testValuesOfKey(MapToMany $c, $offset, $values, $key)
    {
        $this->assertEquals($values, $c->valuesOfKey($key));
    }
}
