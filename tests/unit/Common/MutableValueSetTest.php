<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class MutableValueSetTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param MutableValueSet $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testPutValue(MutableValueSet $collection, $v, $vs, $k, $ks)
    {
        $value = 'MM';
        $this->assertFalse($collection->containsValue($value));
        $collection->putValue($value);
        $this->assertTrue($collection->containsValue($value));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param MutableValueSet $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testPutValues(MutableValueSet $collection, $v, $vs, $k, $ks)
    {
        $values = ['MM', 'NN'];
        $this->assertFalse($collection->containsValue($values[0]));
        $this->assertFalse($collection->containsValue($values[1]));
        $collection->putValues($values);
        $this->assertTrue($collection->containsValue($values[0]));
        $this->assertTrue($collection->containsValue($values[1]));
    }
}
