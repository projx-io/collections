<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class MutableValueListTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param MutableValueSet $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testAddValue(MutableValueList $collection, $v, $vs, $k, $ks)
    {
        $value = 'MM';
        $this->assertFalse($collection->containsValue($value));
        $collection->addValue($value);
        $this->assertTrue($collection->containsValue($value));
    }
}
