<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class MapFromOneTest extends TestCase
{
    /**
     * @dataProvider dataProviderOneToOne
     * @param MapFromOne $c
     * @param int $offset
     * @param mixed $key
     * @param mixed $value
     */
    public function testItemOfValue(MapFromOne $c, $offset, $value, $key)
    {
        $this->assertEntry($key, $value, $c->itemOfValue($value));
    }

    /**
     * @dataProvider dataProviderOneToOne
     * @param MapFromOne $c
     * @param int $offset
     * @param mixed $key
     * @param mixed $value
     */
    public function testKeyOfValue(MapFromOne $c, $offset, $value, $key)
    {
        $this->assertEquals($key, $c->keyOfValue($value));
    }
}
