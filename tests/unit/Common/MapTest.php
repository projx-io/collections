<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class MapTest extends TestCase
{
    /**
     * @dataProvider dataProviderManyToMany
     * @param Map $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     * @param SequentialEntry[] $items
     */
    public function testItemsOfKeys(Map $c, $offsets, $values, $keys, $items)
    {
        $this->assertEquals($items, $c->itemsOfKeys($keys));
    }

    /**
     * @dataProvider dataProviderManyToMany
     * @param Map $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     * @param SequentialEntry[] $items
     */
    public function testItemsOfValues(Map $c, $offsets, $values, $keys, $items)
    {
        $this->assertEquals($items, $c->itemsOfValues($values));
    }

    /**
     * @dataProvider dataProviderManyToMany
     * @param Map $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     * @param SequentialEntry[] $items
     */
    public function testValuesOfKeys(Map $c, $offsets, $values, $keys, $items)
    {
        $this->assertEquals($values, $c->valuesOfKeys($keys));
    }

    /**
     * @dataProvider dataProviderManyToMany
     * @param Map $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     * @param SequentialEntry[] $items
     */
    public function testKeysOfValues(Map $c, $offsets, $values, $keys, $items)
    {
        $this->assertEquals($keys, $c->keysOfValues($values));
    }
}
