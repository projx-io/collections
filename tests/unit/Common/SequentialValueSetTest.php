<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class SequentialValueSetTest extends TestCase
{
    /**
     * @dataProvider dataProviderOneToOne
     * @param SequentialValueSet $c
     * @param int $offset
     * @param mixed $value
     * @param mixed $key
     */
    public function testOffsetsOfValue(SequentialValueSet $c, $offset, $value, $key)
    {
        $this->assertEquals($offset, $c->offsetOfValue($value));
    }
}
