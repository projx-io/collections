<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\SequentialKeyCollection;

class SequentialKeyCollectionTest extends TestCase
{
    public function dataProvider()
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

    public function dataProvider2()
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
     * @dataProvider dataProvider
     * @param SequentialKeyCollection $c
     * @param int $offset
     * @param mixed $value
     * @param mixed $key
     */
    public function testKeyAtOffset(SequentialKeyCollection $c, $offset, $value, $key)
    {
        $this->assertEquals($key, $c->keyAtOffset($offset));
    }

    /**
     * @dataProvider dataProvider2
     * @param SequentialKeyCollection $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     */
    public function testKeysAtOffsets(SequentialKeyCollection $c, $offsets, $values, $keys)
    {
        $this->assertEquals($keys, $c->keysAtOffsets($offsets));
    }

    /**
     * @dataProvider dataProvider2
     * @param SequentialKeyCollection $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     */
    public function testOffsetsOfKeys(SequentialKeyCollection $c, $offsets, $values, $keys)
    {
        $this->assertEquals($offsets, $c->offsetsOfKeys($keys));
    }
}
