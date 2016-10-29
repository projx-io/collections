<?php

namespace ProjxIO\Collections;

use Exception;
use PHPUnit_Framework_TestCase;
use ProjxIO\Collections\Common\Entry;
use ProjxIO\Collections\Common\SequentialEntry;

class TestCase extends PHPUnit_Framework_TestCase
{
    public function generateCombinations($min, $max)
    {
        static $sets = [[[]]];

        for ($i = count($sets); $i <= $max; $i++) {
            $sets[$i] = array_map(function ($set) use ($i) {
                $set[$i] = $i;
                return $set;
            }, call_user_func_array('array_merge', $sets));
        }

        return array_filter(call_user_func_array('array_merge', $sets), function ($set) use ($min, $max) {
            return count($set) >= $min && count($set) <= $max;
        });
    }

    public function combinations(array $items = [], $min = 0, $max = 0)
    {
        $combinations = $this->generateCombinations($min, $max ?: count($items));
        return array_map(function ($combination) use ($items) {
            return [
                array_intersect_key($items, $combination),
                array_diff_key($items, $combination),
            ];
        }, $combinations);
    }

    /**
     * @param $class
     * @param $items
     * @return array
     */
    public function generateCase($class, $items)
    {
        $v = array_unique(array_map($this->value(), $items));
        $ks = $this->group($items, $this->value(), $this->key());
        $k = array_unique(array_map($this->key(), $items));
        $vs = $this->group($items, $this->key(), $this->value());

        return [new $class($items), $v, $ks, $k, $vs];
    }

    /**
     * @return callable
     */
    public function key()
    {
        return function (EntryItem $item) {
            return $item->key();
        };
    }

    /**
     * @return callable
     */
    public function value()
    {
        return function (EntryItem $item) {
            return $item->value();
        };
    }

    public function group($items, $callback, $callback2)
    {
        $names = array_map($callback, $items);
        $groups = array_fill_keys(array_unique($names), []);
        array_map(function ($item, $group, $offset) use (&$groups, $callback2) {
            $groups[$group][$offset] = call_user_func($callback2, $item);
        }, $items, $names, array_keys($items));
        return $groups;
    }

    /**
     * @return callable
     */
    public function offset()
    {
        return function (SequentialEntryItem $item) {
            return $item->offset();
        };
    }

    public function itemsOneToOne()
    {
        return [
            new EntryItem('A', 'U'),
            new EntryItem('B', 'V'),
            new EntryItem('C', 'W'),
            new EntryItem('D', 'X'),
            new EntryItem('E', 'Y'),
            new EntryItem('F', 'Z'),
        ];
    }

    public function itemsOneToMany()
    {
        return [
            new EntryItem('A', 'U'),
            new EntryItem('B', 'V'),
            new EntryItem('C', 'W'),
            new EntryItem('A', 'X'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'Z'),
        ];
    }

    public function itemsManyToOne()
    {
        return [
            new EntryItem('A', 'X'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'Z'),
            new EntryItem('D', 'Z'),
            new EntryItem('E', 'Y'),
            new EntryItem('F', 'X'),
        ];
    }

    public function itemsManyToMany()
    {
        return [
            new EntryItem('A', 'X'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'Z'),
            new EntryItem('A', 'Z'),
            new EntryItem('B', 'Y'),
            new EntryItem('C', 'X'),
        ];
    }

    public function collectionProvider()
    {
        return [
            $this->generateCase(ArrayOneToOne::class, $this->itemsOneToOne()),
            $this->generateCase(ArrayOneToMany::class, $this->itemsOneToMany()),
            $this->generateCase(ArrayManyToOne::class, $this->itemsManyToOne()),
            $this->generateCase(ArrayManyToMany::class, $this->itemsManyToMany()),
        ];
    }

    public function collectionProviderTest()
    {
        $ref = new \ReflectionObject($this);
        $type = str_replace('Test', '', $ref->getName());
        return $this->collectionProviderType($type);
    }

    public function collectionProviderType($type)
    {
        return array_filter($this->collectionProvider(), function ($case) use ($type) {
            return $case[0] instanceof $type;
        });
    }

    public function assertThrows($class, callable $callback, array $params = [])
    {
        $error = null;
        try {
            call_user_func_array($callback, $params);
        } catch (Exception $e) {
            $error = $e;
        }

        $this->assertInstanceOf($class, $error, 'Failed asserting that exception of type ' . $class . ' is thrown.');
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @param Entry $entry
     */
    public function assertEntry($key, $value, Entry $entry)
    {
        $this->assertEquals($key, $entry->key());
        $this->assertEquals($value, $entry->value());
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @param int $offset
     * @param SequentialEntry $entry
     */
    public function assertSequentialEntry($key, $value, $offset, SequentialEntry $entry)
    {
        $this->assertEntry($key, $value, $entry);
        $this->assertEquals($offset, $entry->offset());
    }

    /**
     * @param mixed[] $keys
     * @param mixed[] $values
     * @param Entry[] $entries
     */
    public function assertEntries($keys, $values, $entries)
    {
        foreach ($entries as $i => $entry) {
            $key = $keys[$i];
            $value = $values[$i];
            $this->assertEntry($key, $value, $entry);
        }
    }

    /**
     * @param mixed[] $keys
     * @param mixed[] $values
     * @param Entry[][] $entries
     */
    public function assertEntriesList($keys, $values, $entries)
    {
        array_map([$this, 'assertEntries'], $keys, $values, $entries);
    }

    /**
     * @param Entry $expect
     * @param Entry $actual
     */
    public function assertItem(Entry $expect, Entry $actual)
    {
        $this->assertEntry($expect->key(), $expect->value(), $actual);
    }

    /**
     * @param Entry[] $expects
     * @param Entry[] $actuals
     */
    public function assertItems($expects, $actuals)
    {
        array_map([$this, 'assertItem'], $expects, $actuals);
    }

    /**
     * @param Entry[][] $expects
     * @param Entry[][] $actuals
     */
    public function assertItemsList($expects, $actuals)
    {
        array_map([$this, 'assertItems'], $expects, $actuals);
    }

    /**
     * @param mixed[] $keys
     * @param mixed[] $values
     * @param int[] $offsets
     * @param SequentialEntry[] $entries
     */
    public function assertSequentialEntries($keys, $values, $offsets, $entries)
    {
        foreach ($entries as $i => $entry) {
            $key = $keys[$i];
            $value = $values[$i];
            $offset = $offsets[$i];
            $this->assertSequentialEntry($key, $value, $offset, $entry);
        }
    }
}
