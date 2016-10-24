<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\SequentialEntry;
use ProjxIO\Collections\Common\SequentialItemCollection;

class SequentialItemCollectionTest extends TestCase
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
     * @dataProvider dataProviderOneToOne
     * @param SequentialItemCollection $c
     * @param int $offset
     * @param mixed $value
     * @param mixed $key
     * @param SequentialEntry $item
     */
    public function testItemAtOffset(SequentialItemCollection $c, $offset, $value, $key, $item)
    {
        $this->assertSequentialEntry($key, $value, $offset, $c->itemAtOffset($offset));
    }

    /**
     * @dataProvider dataProviderManyToMany
     * @param SequentialItemCollection $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     * @param SequentialEntry[] $items
     */
    public function testItemsAtOffsets(SequentialItemCollection $c, $offsets, $values, $keys, $items)
    {
        $this->assertSequentialEntries($keys, $values, $offsets, $c->itemsAtOffsets($offsets));
    }

    /**
     * @dataProvider dataProviderManyToMany
     * @param SequentialItemCollection $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     * @param SequentialEntry[] $items
     */
    public function testItemsOfKeys(SequentialItemCollection $c, $offsets, $values, $keys, $items)
    {
        $this->assertSequentialEntries($keys, $values, $offsets, $c->itemsOfKeys($keys));
    }

    /**
     * @dataProvider dataProviderManyToMany
     * @param SequentialItemCollection $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     * @param SequentialEntry[] $items
     */
    public function testItemsOfValues(SequentialItemCollection $c, $offsets, $values, $keys, $items)
    {
        $this->assertSequentialEntries($keys, $values, $offsets, $c->itemsOfValues($values));
    }

    /**
     * @dataProvider dataProviderManyToMany
     * @param SequentialItemCollection $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     * @param SequentialEntry[] $items
     */
    public function testOffsetsOfItems(SequentialItemCollection $c, $offsets, $values, $keys, $items)
    {
        $this->assertEquals($offsets, $c->offsetsOfItems($items));
    }
}
