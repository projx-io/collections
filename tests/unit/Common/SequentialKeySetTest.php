<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class SequentialKeySetTest extends TestCase
{
    /**
     * @dataProvider dataProviderOneToOne
     * @param SequentialKeySet $c
     * @param int $offset
     * @param mixed $value
     * @param mixed $key
     */
    public function testOffsetOfKey(SequentialKeySet $c, $offset, $value, $key)
    {
        $this->assertEquals($offset, $c->offsetOfKey($key));
    }
}
