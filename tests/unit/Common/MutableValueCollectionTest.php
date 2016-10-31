<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class MutableValueCollectionTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param MutableValueCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testRemoveValue(MutableValueCollection $collection, $v, $vs, $k, $ks)
    {
        $value = $v[0];
        $this->assertTrue($collection->containsValue($value));
        $collection->removeValue($value);
        $this->assertFalse($collection->containsValue($value));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param MutableValueCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testRemoveValues(MutableValueCollection $collection, $v, $vs, $k, $ks)
    {
        $values = [$v[0], $v[2]];
        $this->assertTrue($collection->containsValue($v[0]));
        $this->assertTrue($collection->containsValue($v[2]));
        $collection->removeValues($values);
        $this->assertFalse($collection->containsValue($v[0]));
        $this->assertFalse($collection->containsValue($v[2]));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param MutableValueCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testRemoveOffset(MutableValueCollection $collection, $v, $vs, $k, $ks)
    {
        $value = $v[0];
        $this->assertTrue($collection->containsValue($value));
        $collection->removeOffset(0);
        $this->assertFalse($collection->containsValue($value));
    }

    /**
     * @dataProvider collectionProviderTest
     * @param MutableValueCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testRemoveOffsets(MutableValueCollection $collection, $v, $vs, $k, $ks)
    {
        $this->assertTrue($collection->containsValue($v[0]));
        $this->assertTrue($collection->containsValue($v[2]));
        $collection->removeOffsets([0, 2]);
        $this->assertFalse($collection->containsValue($v[0]));
        $this->assertFalse($collection->containsValue($v[2]));
    }
}
