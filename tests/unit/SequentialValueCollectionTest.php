<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\SequentialValueCollection;

class SequentialValueCollectionTest extends TestCase
{
    public function dataProvider()
    {
        $keys = $this->generateArrayOfObjects(self::$size);
        $values = $this->generateArrayOfObjects(self::$size);

        $collections = [
            new ArraySequentialValueList($values),
            new ArraySequentialValueSet($values),
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
            new ArraySequentialValueList($values),
            new ArraySequentialValueSet($values),
            new ArraySequentialOneToOne($keys, $values),
            new ArraySequentialOneToMany($keys, $values),
            new ArraySequentialManyToOne($keys, $values),
            new ArraySequentialManyToMany($keys, $values),
        ];

        return $this->generateCollectionCasesManyToMany($collections, $values, $keys);
    }

    /**
     * @dataProvider dataProvider
     * @param SequentialValueCollection $c
     * @param int $offset
     * @param mixed $value
     * @param mixed $key
     */
    public function testValueAtOffset(SequentialValueCollection $c, $offset, $value, $key)
    {
        $this->assertEquals($value, $c->valueAtOffset($offset));
    }

    /**
     * @dataProvider dataProvider2
     * @param SequentialValueCollection $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     */
    public function testValuesAtOffsets(SequentialValueCollection $c, $offsets, $values, $keys)
    {
        $this->assertEquals($values, $c->valuesAtOffsets($offsets));
    }

    /**
     * @dataProvider dataProvider2
     * @param SequentialValueCollection $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     */
    public function testOffsetsOfValues(SequentialValueCollection $c, $offsets, $values, $keys)
    {
        $this->assertEquals($offsets, $c->offsetsOfValues($values));
    }
}
