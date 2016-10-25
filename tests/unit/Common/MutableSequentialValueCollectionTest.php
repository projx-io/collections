<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class MutableSequentialValueCollectionTest extends TestCase
{
    /**
     * @dataProvider dataProviderManyToMany
     * @param MutableSequentialValueCollection $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     * @param SequentialEntry[] $items
     */
    public function testInsertValue(MutableSequentialValueCollection $c, $offsets, $values, $keys, $items)
    {
        $c->insertValue(0, 'a');
        $c->insertValue(1, 'b');
        $c->insertValue(1, 'c');
        $this->assertContains('a', $c->valueAtOffset(0));
        $this->assertContains('c', $c->valueAtOffset(1));
        $this->assertContains('b', $c->valueAtOffset(2));
    }

    /**
     * @dataProvider dataProviderManyToMany
     * @param MutableSequentialValueCollection $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     * @param SequentialEntry[] $items
     */
    public function testPushValueFront(MutableSequentialValueCollection $c, $offsets, $values, $keys, $items)
    {
        $c->pushValueFront('a');
        $this->assertContains('a', $c->valueAtOffset(0));
    }

    /**
     * @dataProvider dataProviderManyToMany
     * @param MutableSequentialValueCollection $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     * @param SequentialEntry[] $items
     */
    public function testPushValueBack(MutableSequentialValueCollection $c, $offsets, $values, $keys, $items)
    {
        $c->pushValueBack('a');
        $this->assertTrue($c->containsValue('a'));
    }

    /**
     * @depends testInsertValue
     * @dataProvider dataProviderManyToMany
     * @param MutableSequentialValueCollection $c
     * @param int[] $offsets
     * @param mixed[] $values
     * @param mixed[] $keys
     * @param SequentialEntry[] $items
     */
    public function testRemove(MutableSequentialValueCollection $c, $offsets, $values, $keys, $items)
    {
        $c->insertValue(0, 'a');
        $c->insertValue(1, 'b');
        $c->insertValue(1, 'c');
        $c->removeAt(1);
        $this->assertContains('a', $c->valueAtOffset(0));
        $this->assertContains('b', $c->valueAtOffset(1));
    }
}
