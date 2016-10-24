<?php

namespace ProjxIO\Collections;

use Countable;
use Exception;
use PHPUnit_Framework_TestCase;
use ProjxIO\Collections\Common\Entry;
use ProjxIO\Collections\Common\SequentialEntry;
use ProjxIO\Collections\Common\SequentialItem;
use Traversable;

class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Controls the size of the containers that are generated
     *
     * @var int
     */
    public static $size = 6;

    public function generateCollectionCasesOneToOne($collections, $values = [], $keys = [])
    {
        $offsets = range(0, count($values) - 1);
        $items = $this->generateArrayOfItems($keys, $values);

        $cases = [];

        foreach ($collections as $collection) {
            foreach ($offsets as $i => $case_offsets) {
                $case_key = $keys[$i];
                $case_value = $values[$i];
                $case_item = $items[$i];
                $cases[] = [$collection, $case_offsets, $case_value, $case_key, $case_item];
            }
        }

        return $cases;
    }

    public function generateCollectionCasesManyToMany($collections, $values = [], $keys = [])
    {
        $items = $this->generateArrayOfItems($keys, $values);

        $combinations_offsets = $this->combinations(range(0, count($keys) - 1));
        $combinations_keys = $this->combinations($keys);
        $combinations_values = $this->combinations($values);
        $combinations_items = $this->combinations($items);

        $cases = [];

        foreach ($collections as $collection) {
            foreach ($combinations_offsets as $i => $case_offsets) {
                $case_keys = $combinations_keys[$i];
                $case_values = $combinations_values[$i];
                $case_items = $combinations_items[$i];
                $cases[] = [$collection, $case_offsets, $case_values, $case_keys, $case_items];
            }
        }

        return $cases;
    }

    public function generateItems($n)
    {
        return $this->generateArrayOfItems($this->generateArrayOfObjects($n), $this->generateArrayOfObjects($n));
    }

    public function generateArrayOfItems($keys, $values, $offsets = null)
    {
        return array_map(function ($key, $value, $offset) {
            return new SequentialItem($key, $value, $offset);
        }, $keys, $values, $offsets ? $offsets : range(0, count($keys) - 1));
    }

    public function generateArrayOfObjects($n)
    {
        return array_map(function ($i) {
            return (object)[
                'index' => $i,
                'data' => bin2hex(openssl_random_pseudo_bytes(8))
            ];
        }, range(0, $n - 1));
    }

    public function combinations($values)
    {
        $n = (is_array($values) || $values instanceof Countable) ? count($values) : $values;

        static $combinations = [[[]]];

        for ($i = count($combinations); $i <= $n; $i++) {
            $sets = $combinations[$i - 1];
            $combination = [];
            foreach ($sets as $set) {
                $combination[] = array_merge($set, [$i - 1]);
            }
            $combinations[$i] = array_merge($combinations[$i - 1], $combination);
        }

        if (is_array($values) || $values instanceof Traversable) {
            $combination = $combinations[$n];
            $sets = [];

            foreach ($combination as $offsets) {
                $set = [];
                foreach ($offsets as $offset) {
                    $set[] = $values[$offset];
                }
                $sets[] = $set;
            }

            return $sets;
        }

        return $combinations[$n];
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
     * @param Entry $expect
     * @param Entry $actual
     */
    public function assertItem(Entry $expect, Entry $actual)
    {
        $this->assertEquals($expect->value(), $actual->value());
        $this->assertEquals($expect->key(), $actual->key());
    }

    /**
     * @param Entry[] $expects
     * @param Entry[] $actuals
     */
    public function assertItems($expects, $actuals)
    {
        foreach ($expects as $i => $entry) {
            $actual = $actuals[$i];
            $this->assertItem($entry, $actual);
        }
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