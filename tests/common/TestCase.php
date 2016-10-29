<?php

namespace ProjxIO\Collections;

use Exception;
use PHPUnit_Framework_TestCase;
use ProjxIO\Collections\Common\Entry;
use ProjxIO\Collections\Common\SequentialEntry;

class TestCase extends PHPUnit_Framework_TestCase
{
    public function collectionProvider()
    {
        return [
            [
                new ArrayManyToMany([
                    new EntryItem('A', 'X'),
                    new EntryItem('B', 'Y'),
                    new EntryItem('C', 'Z'),
                    new EntryItem('D', 'X'),
                    new EntryItem('A', 'Y'),
                    new EntryItem('B', 'Z'),
                ])
            ],
            [
                new ArrayManyToOne([
                    new EntryItem('A', 'X'),
                    new EntryItem('B', 'Y'),
                    new EntryItem('C', 'Z'),
                    new EntryItem('D', 'X'),
                    new EntryItem('E', 'Y'),
                    new EntryItem('F', 'Z'),
                ])
            ],
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
