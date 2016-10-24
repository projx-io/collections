<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class SequentialKeyListTest extends TestCase
{
    /**
     * @dataProvider dataProviderOneToMany
     * @param SequentialKeyList $c
     * @param int[] $offsets
     * @param mixed $value
     * @param mixed $key
     */
    public function testOffsetsOfKey(SequentialKeyList $c, $offsets, $value, $key)
    {
        $this->assertEquals($offsets, $c->offsetsOfKey($key));
    }
}
