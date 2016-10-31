<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class ArrayCollectionTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param ArrayCollection $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testToArray(ArrayCollection $collection, $v, $vs, $k, $ks)
    {
        $expect = array_values($v);
        $actual = array_values($collection->toArray());
        $this->assertEquals($expect, $actual);
    }
}
