<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class SequentialValueListTest extends TestCase
{
    /**
     * @dataProvider dataProviderManyToOne
     * @param SequentialValueList $c
     * @param int[] $offsets
     * @param mixed $value
     * @param mixed[] $keys
     */
    public function testOffsetsOfValue(SequentialValueList $c, $offsets, $value, $keys)
    {
        $this->assertEquals($offsets, $c->offsetsOfValue($value));
    }
}
