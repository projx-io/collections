<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class MapToOneTest extends TestCase
{
    /**
     * @dataProvider dataProviderOneToOne
     * @param MapToOne $c
     * @param int $offset
     * @param mixed $key
     * @param mixed $value
     */
    public function testItemOfKey(MapToOne $c, $offset, $value, $key)
    {
        $this->assertEntry($key, $value, $c->itemOfKey($key));
    }

    /**
     * @dataProvider dataProviderOneToOne
     * @param MapToOne $c
     * @param int $offset
     * @param mixed $key
     * @param mixed $value
     */
    public function testKeyOfKey(MapToOne $c, $offset, $value, $key)
    {
        $this->assertEquals($value, $c->valueOfKey($key));
    }
}
