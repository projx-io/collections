<?php

namespace ProjxIO\Collections;

class ArraySequenceTest extends TestCase
{
    public function testCombine()
    {
        $keys = new ArraySequence(['a', 'b', 'c']);
        $values = new ArraySequence(['A', 'B', 'C']);
        $actual = $keys->combine($values);

        $this->assertEquals(['a', 'b', 'c'], $actual->keys()->toArray());
        $this->assertEquals(['A', 'B', 'C'], $actual->values()->toArray());
    }

    public function testCombineInvalid()
    {
        $this->assertThrows(CountMismatchException::class, function () {
            $keys = new ArraySequence(['a', 'b', 'c']);
            $values = new ArraySequence(['A', 'B', 'C', 'D']);

            $keys->combine($values);
        });
    }

    public function testWithOffsets()
    {
        $actual = (new ArraySequence(['a', 'b', 'c']))->withOffsets();
        $this->assertEquals(0, $actual->valueAt(0)->key);
        $this->assertEquals('a', $actual->valueAt(0)->value);
        $this->assertEquals(1, $actual->valueAt(1)->key);
        $this->assertEquals('b', $actual->valueAt(1)->value);
        $this->assertEquals(2, $actual->valueAt(2)->key);
        $this->assertEquals('c', $actual->valueAt(2)->value);
    }

    public function testSort()
    {
        $actual = (new ArraySequence(['a', 'b', 'c']))->withOffsets()
            ->sort(function (Entry $a, Entry $b) {
                return $b->value - $a->value;
            });

        $this->assertEquals(2, $actual->valueAt(0)->key);
        $this->assertEquals('c', $actual->valueAt(0)->value);
        $this->assertEquals(1, $actual->valueAt(1)->key);
        $this->assertEquals('b', $actual->valueAt(1)->value);
        $this->assertEquals(0, $actual->valueAt(2)->key);
        $this->assertEquals('a', $actual->valueAt(2)->value);
    }
}
