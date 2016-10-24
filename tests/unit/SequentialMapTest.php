<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\Map;
use ProjxIO\Collections\Common\SequentialEntry;

class SequentialMapTest extends TestCase
{
    public function dataProviderOneToOne()
    {
        $keys = $this->generateArrayOfObjects(self::$size);
        $values = $this->generateArrayOfObjects(self::$size);

        $collections = [
            new ArraySequentialOneToOne($keys, $values),
            new ArraySequentialOneToMany($keys, $values),
            new ArraySequentialManyToOne($keys, $values),
            new ArraySequentialManyToMany($keys, $values),
        ];

        return $this->generateCollectionCasesOneToOne($collections, $values, $keys);
    }

    public function dataProviderManyToMany()
    {
        $keys = $this->generateArrayOfObjects(self::$size);
        $values = $this->generateArrayOfObjects(self::$size);

        $collections = [
            new ArraySequentialOneToOne($keys, $values),
            new ArraySequentialOneToMany($keys, $values),
            new ArraySequentialManyToOne($keys, $values),
            new ArraySequentialManyToMany($keys, $values),
        ];

        return $this->generateCollectionCasesManyToMany($collections, $values, $keys);
    }

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
