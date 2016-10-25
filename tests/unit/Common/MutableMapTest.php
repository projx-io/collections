<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class MutableMapTest extends TestCase
{
    /**
     * @dataProvider dataProviderManyToMany
     * @param MutableMap $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     * @param SequentialEntry[] $items
     */
    public function testPut(MutableMap $c, $offsets, $values, $keys, $items)
    {
        $c->put('a', 'A');
        $this->assertContains('a', $c->keysOfValues(['A']));
        $this->assertContains('A', $c->valuesOfKeys(['a']));
    }

    /**
     * @depends testPut
     * @dataProvider dataProviderManyToMany
     * @param MutableMap $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     * @param SequentialEntry[] $items
     */
    public function testRemove(MutableMap $c, $offsets, $values, $keys, $items)
    {
        $c->put('a', 'A');
        $c->remove('a', 'A');
        $this->assertNotContains('a', $c->keysOfValues(['A']));
        $this->assertNotContains('A', $c->valuesOfKeys(['a']));
    }
}
