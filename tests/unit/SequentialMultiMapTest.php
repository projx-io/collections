<?php

namespace ProjxIO\Collections;

class SequentialMultiMapTest extends TestCase
{
    public function testFrom()
    {
        $c = SequentialMultiMap::from(['a' => 'A', 'b' => 'B']);
        $c->pushBackEntries(['a' => 'AA', 'b' => 'BB']);

        $this->assertEquals([0], $c->offsetsOfValue('A')->toArray());
        $this->assertEquals([1], $c->offsetsOfValue('B')->toArray());
        $this->assertEquals([2], $c->offsetsOfValue('AA')->toArray());
        $this->assertEquals([3], $c->offsetsOfValue('BB')->toArray());
    }

    public function testOffsetsOfKey()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');

        $this->assertEquals([0, 2], $c->offsetsOfKey('a')->toArray());
        $this->assertEquals([1, 3], $c->offsetsOfKey('b')->toArray());
    }

    public function testPushBackEntry()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');

        $this->assertEquals([0], $c->offsetsOfValue('A')->toArray());
        $this->assertEquals([1], $c->offsetsOfValue('B')->toArray());
        $this->assertEquals([2], $c->offsetsOfValue('AA')->toArray());
        $this->assertEquals([3], $c->offsetsOfValue('BB')->toArray());
    }

    public function testPushBackEntries()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntries(['a' => 'A', 'b' => 'B']);
        $c->pushBackEntries(['a' => 'AA', 'b' => 'BB']);

        $this->assertEquals([0], $c->offsetsOfValue('A')->toArray());
        $this->assertEquals([1], $c->offsetsOfValue('B')->toArray());
        $this->assertEquals([2], $c->offsetsOfValue('AA')->toArray());
        $this->assertEquals([3], $c->offsetsOfValue('BB')->toArray());
    }

    public function testOffsetsOfValue()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');

        $this->assertEquals([0], $c->offsetsOfValue('A')->toArray());
        $this->assertEquals([1], $c->offsetsOfValue('B')->toArray());
        $this->assertEquals([2], $c->offsetsOfValue('AA')->toArray());
        $this->assertEquals([3], $c->offsetsOfValue('BB')->toArray());
    }

    public function testOffsetsOfEntry()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $this->assertEquals([4], $c->offsetsOfEntry('c', 'A')->toArray());
        $this->assertEquals([5], $c->offsetsOfEntry('c', 'B')->toArray());
        $this->assertEquals([], $c->offsetsOfEntry('c', 'AA')->toArray());
        $this->assertEquals([], $c->offsetsOfEntry('c', 'BB')->toArray());
    }

    public function testKeysOf()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $this->assertEquals(['a', 'c'], $c->keysOf('A')->toArray());
        $this->assertEquals(['b', 'c'], $c->keysOf('B')->toArray());
        $this->assertEquals(['a'], $c->keysOf('AA')->toArray());
        $this->assertEquals(['b'], $c->keysOf('BB')->toArray());
    }

    public function testValuesOf()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $this->assertEquals(['A', 'AA'], $c->valuesOf('a')->toArray());
        $this->assertEquals(['B', 'BB'], $c->valuesOf('b')->toArray());
        $this->assertEquals(['A', 'B'], $c->valuesOf('c')->toArray());
    }

    public function testKeys()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $this->assertEquals(['a', 'b', 'a', 'b', 'c', 'c'], $c->keys()->toArray());
    }

    public function testValues()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $this->assertEquals(['A', 'B', 'AA', 'BB', 'A', 'B'], $c->values()->toArray());
    }

    public function testValuesAt()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $this->assertEquals(['A', 'AA', 'B'], $c->valuesAt([0, 2, 5])->toArray());
    }

    public function testKeysAt()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $this->assertEquals(['a', 'a', 'c'], $c->keysAt([0, 2, 5])->toArray());
    }

    public function testEntriesAt()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $this->assertEquals(['a', 'a', 'c'], $c->entriesAt([0, 2, 5])->keys()->toArray());
        $this->assertEquals(['A', 'AA', 'B'], $c->entriesAt([0, 2, 5])->values()->toArray());
    }

    public function testIntersectKeys()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $this->assertEquals(['a', 'a'], $c->intersectKeys('a')->keys()->toArray());
        $this->assertEquals(['A', 'AA'], $c->intersectKeys('a')->values()->toArray());
    }

    public function testIntersectValues()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $this->assertEquals(['a', 'c'], $c->intersectValues('A')->keys()->toArray());
        $this->assertEquals(['A', 'A'], $c->intersectValues('A')->values()->toArray());
    }

    public function testIntersectEntries()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $this->assertEquals(['a', 'c'], $c->intersectEntries(['a' => 'AA', 'c' => 'A', 'z' => 'A', 'b' => 'Z'])->keys()->toArray());
        $this->assertEquals(['AA', 'A'], $c->intersectEntries(['a' => 'AA', 'c' => 'A', 'z' => 'A', 'b' => 'Z'])->values()->toArray());
    }

    public function testContainsKey()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $this->assertTrue($c->containsKey('c'));
        $this->assertFalse($c->containsKey('z'));
    }

    public function testContainsValue()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $this->assertTrue($c->containsValue('AA'));
        $this->assertFalse($c->containsValue('Z'));
    }

    public function testContainsEntry()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $this->assertTrue($c->containsEntry('b', 'BB'));
        $this->assertFalse($c->containsEntry('b', 'Z'));
        $this->assertFalse($c->containsEntry('z', 'BB'));
    }

    public function testGetIterator()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $iterator = $c->getIterator();
        for ($offset = 0; $offset < $c->count(); $offset++) {
            $this->assertEquals($c->keyAt($offset), $iterator->key());
            $this->assertEquals($c->valueAt($offset), $iterator->current());
            $iterator->next();
        }
    }

    public function testRemoveOffset()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $c->removeOffset(3);
        $this->assertEquals(['a', 'b', 'a', 'c', 'c'], $c->keys()->toArray());
        $this->assertEquals(['A', 'B', 'AA', 'A', 'B'], $c->values()->toArray());
    }

    public function testRemoveOffsets()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $c->removeOffsets([1, 3, 5]);
        $this->assertEquals(['a', 'a', 'c'], $c->keys()->toArray());
        $this->assertEquals(['A', 'AA', 'A'], $c->values()->toArray());
    }

    public function testRemoveKey()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $c->removeKey('a');
        $this->assertEquals(['b', 'b', 'c', 'c'], $c->keys()->toArray());
        $this->assertEquals(['B', 'BB', 'A', 'B'], $c->values()->toArray());
    }

    public function testRemoveKeys()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $c->removeKeys(['a', 'c']);
        $this->assertEquals(['b', 'b'], $c->keys()->toArray());
        $this->assertEquals(['B', 'BB'], $c->values()->toArray());
    }

    public function testRemoveValue()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $c->removeValue('A');
        $this->assertEquals(['b', 'a', 'b', 'c'], $c->keys()->toArray());
        $this->assertEquals(['B', 'AA', 'BB', 'B'], $c->values()->toArray());
    }

    public function testRemoveValues()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $c->removeValues(['A', 'AA']);
        $this->assertEquals(['b', 'b', 'c'], $c->keys()->toArray());
        $this->assertEquals(['B', 'BB', 'B'], $c->values()->toArray());
    }

    public function testRemoveEntry()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $c->removeEntry('c', 'A');
        $this->assertEquals(['a', 'b', 'a', 'b', 'c'], $c->keys()->toArray());
        $this->assertEquals(['A', 'B', 'AA', 'BB', 'B'], $c->values()->toArray());
    }

    public function testMap()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $actual = $c->map(function (Entry $entry) {
            $entry->key .= $entry->offset;
            $entry->value .= $entry->offset;
        });

        $this->assertEquals(['a0', 'b1', 'a2', 'b3', 'c4', 'c5'], $actual->keys()->toArray());
        $this->assertEquals(['A0', 'B1', 'AA2', 'BB3', 'A4', 'B5'], $actual->values()->toArray());
    }

    public function testMapToValues()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $actual = $c->mapToValues(function (Entry $entry) {
            $entry->key .= $entry->offset;
            $entry->value .= $entry->offset;
        });

        $this->assertEquals(['a', 'b', 'a', 'b', 'c', 'c'], $actual->keys()->toArray());
        $this->assertEquals(['A0', 'B1', 'AA2', 'BB3', 'A4', 'B5'], $actual->values()->toArray());
    }

    public function testMapToKeys()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $actual = $c->mapToKeys(function (Entry $entry) {
            $entry->key .= $entry->offset;
            $entry->value .= $entry->offset;
        });

        $this->assertEquals(['a0', 'b1', 'a2', 'b3', 'c4', 'c5'], $actual->keys()->toArray());
        $this->assertEquals(['A', 'B', 'AA', 'BB', 'A', 'B'], $actual->values()->toArray());
    }

    public function testMapValues()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $actual = $c->mapValues(function ($value) {
            return '_' . $value;
        });

        $this->assertEquals(['a', 'b', 'a', 'b', 'c', 'c'], $actual->keys()->toArray());
        $this->assertEquals(['_A', '_B', '_AA', '_BB', '_A', '_B'], $actual->values()->toArray());
    }

    public function testMapKeys()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $actual = $c->mapKeys(function ($key) {
            return '_' . $key;
        });

        $this->assertEquals(['_a', '_b', '_a', '_b', '_c', '_c'], $actual->keys()->toArray());
        $this->assertEquals(['A', 'B', 'AA', 'BB', 'A', 'B'], $actual->values()->toArray());
    }

    public function testMapKeysToValues()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $actual = $c->mapKeysToValues(function ($key) {
            return '_' . $key;
        });

        $this->assertEquals(['a', 'b', 'a', 'b', 'c', 'c'], $actual->keys()->toArray());
        $this->assertEquals(['_a', '_b', '_a', '_b', '_c', '_c'], $actual->values()->toArray());
    }

    public function testMapValuesToKeys()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $actual = $c->mapValuesToKeys(function ($value) {
            return '_' . $value;
        });

        $this->assertEquals(['_A', '_B', '_AA', '_BB', '_A', '_B'], $actual->keys()->toArray());
        $this->assertEquals(['A', 'B', 'AA', 'BB', 'A', 'B'], $actual->values()->toArray());
    }

    public function testFilter()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $actual = $c->filter(function (Entry $entry) {
            return $entry->offset % 2 > 0;
        });

        $this->assertEquals(['b', 'b', 'c'], $actual->keys()->toArray());
        $this->assertEquals(['B', 'BB', 'B'], $actual->values()->toArray());
    }

    public function testFilterValues()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $actual = $c->filterValues(function ($value) {
            return strlen($value) % 2 > 0;
        });

        $this->assertEquals(['a', 'b', 'c', 'c'], $actual->keys()->toArray());
        $this->assertEquals(['A', 'B', 'A', 'B'], $actual->values()->toArray());
    }

    public function testFilterKeys()
    {
        $c = new SequentialMultiMap();
        $c->pushBackEntry('a', 'A');
        $c->pushBackEntry('b', 'B');
        $c->pushBackEntry('a', 'AA');
        $c->pushBackEntry('b', 'BB');
        $c->pushBackEntry('c', 'A');
        $c->pushBackEntry('c', 'B');

        $actual = $c->filterKeys(function ($key) {
            return ord($key) % 2 > 0;
        });

        $this->assertEquals(['a', 'a', 'c', 'c'], $actual->keys()->toArray());
        $this->assertEquals(['A', 'AA', 'A', 'B'], $actual->values()->toArray());
    }

    public function testObjectsAsKeys()
    {
        $_1__ = (object)[];
        $__2_ = (object)[];

        $c = new SequentialMultiMap();
        $c->pushBackEntry($_1__, $_1__);
        $c->pushBackEntry($_1__, $__2_);
        $c->pushBackEntry($__2_, $_1__);
        $c->pushBackEntry($__2_, $_1__);

        $this->assertEquals([0], $c->offsetsOfEntry($_1__, $_1__)->toArray());
        $this->assertEquals([1], $c->offsetsOfEntry($_1__, $__2_)->toArray());
        $this->assertEquals([2, 3], $c->offsetsOfEntry($__2_, $_1__)->toArray());
        $this->assertEquals([], $c->offsetsOfEntry($__2_, $__2_)->toArray());

        $this->assertTrue($c->containsEntry($_1__, $_1__));
        $this->assertTrue($c->containsEntry($_1__, $__2_));
        $this->assertTrue($c->containsEntry($__2_, $_1__));
        $this->assertFalse($c->containsEntry($__2_, $__2_));

        $iterator = $c->getIterator();
        for ($offset = 0; $offset < $c->count(); $offset++) {
            $this->assertEquals($c->keyAt($offset), $iterator->key());
            $this->assertEquals($c->valueAt($offset), $iterator->current());
            $iterator->next();
        }
    }
}
