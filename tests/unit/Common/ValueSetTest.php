<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\EntryItem;
use ProjxIO\Collections\TestCase;

class ValueSetTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param ValueSet $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetOfValue(ValueSet $collection, $v, $vs, $k, $ks)
    {
        $expect = array_keys($ks[$v[0]])[0];
        $actual = $collection->offsetOfValue($v[0]);
        $this->assertEquals($expect, $actual);
    }

    /**
     * @dataProvider collectionProviderTest
     * @param ValueSet $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testOffsetOfValues(ValueSet $collection, $v, $vs, $k, $ks)
    {
        $expect = [array_keys($ks[$v[0]])[0], array_keys($ks[$v[1]])[0]];
        $actual = $collection->offsetOfValues([$v[0], $v[1]]);
        $this->assertEquals($expect, $actual);
    }
}
