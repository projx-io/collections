<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class MapFromManyTest extends TestCase
{
    /**
     * @dataProvider dataProviderManyToOne
     * @param MapFromMany $c
     * @param int $offset
     * @param mixed $value
     * @param mixed[] $key
     * @param Entry[] $items
     */
    public function testItemsOfValue(MapFromMany $c, $offset, $value, $keys, $items)
    {
        $this->assertItems($items, $c->itemsOfValue($value));
    }

    /**
     * @dataProvider dataProviderManyToOne
     * @param MapFromMany $c
     * @param int $offset
     * @param mixed $value
     * @param mixed[] $keys
     */
    public function testKeysOfValue(MapFromMany $c, $offset, $value, $keys)
    {
        $this->assertEquals($keys, $c->keysOfValue($value));
    }
}
