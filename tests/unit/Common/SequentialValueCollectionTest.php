<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class SequentialValueCollectionTest extends TestCase
{
    /**
     * @dataProvider dataProviderOneToOne
     * @param SequentialValueCollection $c
     * @param int $offset
     * @param mixed $value
     * @param mixed $key
     */
    public function testContainsValue(SequentialValueCollection $c, $offset, $value, $key)
    {
        $this->assertTrue($c->containsValue($value));
    }

    /**
     * @dataProvider dataProviderOneToOne
     * @param SequentialValueCollection $c
     * @param int $offset
     * @param mixed $value
     * @param mixed $key
     */
    public function testNotContainsValue(SequentialValueCollection $c, $offset, $value, $key)
    {
        $this->assertFalse($c->containsValue('no value here'));
    }

    /**
     * @dataProvider dataProviderOneToOne
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
     * @dataProvider dataProviderManyToMany
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
     * @dataProvider dataProviderManyToMany
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
