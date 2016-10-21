<?php

namespace ProjxIO\Collections;

use Countable;
use IteratorAggregate;

/**
 * @package ProjxIO\Collections
 */
class SequentialMultiMap implements Countable, IteratorAggregate
{
    public static function from($entries)
    {
        $collection = new SequentialMultiMap();
        $collection->pushBackEntries($entries);
        return $collection;
    }

    /**
     * @var Sequence
     */
    private $keys;

    /**
     * @var Sequence
     */
    private $values;

    /**
     *
     * @param Sequence $keys
     * @param Sequence $values
     */
    public function __construct(Sequence $keys = null, Sequence $values = null)
    {
        $this->keys = $keys ?: new ArraySequence();
        $this->values = $values ?: new ArraySequence();
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        foreach ($this->keys as $offset => $key) {
            $value = $this->values->valueAt($offset);
            yield $key => $value;
        }
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return $this->keys->count();
    }

    /**
     * @return Sequence
     */
    public function keys()
    {
        return $this->keys;
    }

    /**
     * @return Sequence
     */
    public function values()
    {
        return $this->values;
    }

    /**
     * @param mixed $key
     * @return Sequence
     */
    public function offsetsOfKey($key)
    {
        return $this->keys->offsetsOf($key);
    }

    /**
     * @param mixed $value
     * @return Sequence
     */
    public function offsetsOfValue($value)
    {
        return $this->values->offsetsOf($value);
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @return Sequence
     */
    public function offsetsOfEntry($key, $value)
    {
        return $this->offsetsOfKey($key)->intersect($this->offsetsOfValue($value));
    }

    /**
     * @param $offset
     * @return mixed
     */
    public function keyAt($offset)
    {
        return $this->keys->valueAt($offset);
    }

    /**
     * @param $offsets
     * @return Sequence
     */
    public function keysAt($offsets)
    {
        return $this->keys->valuesAt($offsets);
    }

    /**
     * @param $offset
     * @return mixed
     */
    public function valueAt($offset)
    {
        return $this->values->valueAt($offset);
    }

    /**
     * @param $offsets
     * @return Sequence
     */
    public function valuesAt($offsets)
    {
        return $this->values->valuesAt($offsets);
    }

    /**
     * @param $offsets
     * @return SequentialMultiMap
     */
    public function entriesAt($offsets)
    {
        return new SequentialMultiMap($this->keysAt($offsets), $this->valuesAt($offsets));
    }

    /**
     * @param mixed $value
     * @return Sequence
     */
    public function keysOf($value)
    {
        return $this->keysAt($this->offsetsOfValue($value));
    }

    /**
     * @param mixed $key
     * @return Sequence
     */
    public function valuesOf($key)
    {
        return $this->valuesAt($this->offsetsOfKey($key));
    }

    /**
     * @param mixed $keys
     * @return SequentialMultiMap
     */
    public function intersectKeys($keys)
    {
        return $this->entriesAt($this->offsetsOfKey($keys));
    }

    /**
     * @param mixed $values
     * @return SequentialMultiMap
     */
    public function intersectValues($values)
    {
        return $this->entriesAt($this->offsetsOfValue($values));
    }

    /**
     * @param mixed $entries
     * @return SequentialMultiMap
     */
    public function intersectEntries($entries)
    {
        $offsets = new ArraySequence();

        foreach ($entries as $key => $value) {
            $offsets->pushBackValues($this->offsetsOfEntry($key, $value));
        }

        return $this->entriesAt($offsets->unique()->sort());
    }

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function pushBackEntry($key, $value)
    {
        $this->keys->pushBack($key);
        $this->values->pushBack($value);
    }

    /**
     * @param $entries
     */
    public function pushBackEntries($entries)
    {
        foreach ($entries as $key => $value) {
            $this->pushBackEntry($key, $value);
        }
    }

    /**
     * @param mixed $key
     * @return bool
     */
    public function containsKey($key)
    {
        return $this->keys->contains($key);
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function containsValue($value)
    {
        return $this->values->contains($value);
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @return bool
     */
    public function containsEntry($key, $value)
    {
        return $this->valuesOf($key)->contains($value);
    }

    /**
     * @param $offset
     */
    public function removeOffset($offset)
    {
        $this->keys->removeOffsets([$offset]);
        $this->values->removeOffsets([$offset]);
    }

    /**
     * @param $offsets
     */
    public function removeOffsets($offsets)
    {
        $this->keys->removeOffsets($offsets);
        $this->values->removeOffsets($offsets);
    }

    /**
     * @param $key
     */
    public function removeKey($key)
    {
        $this->removeOffsets($this->offsetsOfKey($key));
    }

    /**
     * @param $keys
     */
    public function removeKeys($keys)
    {
        $keys = new ArraySequence($keys);
        foreach ($keys as $key) {
            $this->removeKey($key);
        }
    }

    /**
     * @param $values
     */
    public function removeValues($values)
    {
        $values = new ArraySequence($values);
        foreach ($values as $value) {
            $this->removeValue($value);
        }
    }

    /**
     * @param $value
     */
    public function removeValue($value)
    {
        $this->removeOffsets($this->offsetsOfValue($value));
    }

    /**
     * @param $key
     * @param $value
     */
    public function removeEntry($key, $value)
    {
        $this->removeOffsets($this->offsetsOfEntry($key, $value));
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function each(callable $callback)
    {
        foreach ($this->withKeys() as $entry) {
            call_user_func($callback, $entry);
        }
        return $this;
    }

    /**
     * @param callable $callback
     * @return SequentialMultiMap
     */
    public function map(callable $callback)
    {
        $entries = new SequentialMultiMap();

        $this->each(function (Entry $from) use ($callback, $entries) {
            $to = call_user_func($callback, $from) ?: $from;
            $entries->pushBackEntry($to->key, $to->value);
        });

        return $entries;
    }

    public function withKeys()
    {
        $entries = new SequentialMultiMap();
        $offset = 0;
        foreach ($this as $key => $value) {
            $entries->pushBackEntry($key, new Pair($key, $value, $offset++));
        }
        return $entries;
    }

    /**
     * @param callable $callback
     * @return SequentialMultiMap
     */
    public function mapToValues(callable $callback = null)
    {
        return $this->map(function (Entry $entry) use ($callback) {
            $from = new Pair($entry->key, $entry->value, $entry->offset);
            $to = ($callback !== null ? call_user_func($callback, $from) : null) ?: $from;
            $entry->value = $to->value;
        });
    }

    /**
     * @param callable $callback
     * @return SequentialMultiMap
     */
    public function mapToKeys(callable $callback = null)
    {
        return $this->map(function (Entry $entry) use ($callback) {
            $from = new Pair($entry->key, $entry->value, $entry->offset);
            $to = ($callback !== null ? call_user_func($callback, $from) : null) ?: $from;
            $entry->key = $to->key;
        });
    }

    /**
     * @param callable $callback
     * @return SequentialMultiMap
     */
    public function mapValues(callable $callback)
    {
        return $this->map(function (Entry $entry) use ($callback) {
            $entry->value = call_user_func($callback, $entry->value) ?: $entry->value;
        });
    }

    /**
     * @param callable $callback
     * @return SequentialMultiMap
     */
    public function mapValuesToKeys(callable $callback = null)
    {
        return $this->map(function (Entry $entry) use ($callback) {
            $entry->key = ($callback !== null ? call_user_func($callback, $entry->value) : null) ?: $entry->value;
        });
    }

    /**
     * @param callable $callback
     * @return SequentialMultiMap
     */
    public function mapKeysToValues(callable $callback = null)
    {
        return $this->map(function (Entry $entry) use ($callback) {
            $entry->value = ($callback !== null ? call_user_func($callback, $entry->key) : null) ?: $entry->key;
        });
    }

    /**
     * @param callable $callback
     * @return SequentialMultiMap
     */
    public function mapKeys(callable $callback)
    {
        return $this->map(function (Entry $entry) use ($callback) {
            $entry->key = call_user_func($callback, $entry->key) ?: $entry->key;
        });
    }

    /**
     * @param callable|null $callback
     * @return SequentialMultiMap
     */
    public function filterValues(callable $callback = null)
    {
        return $this->filter(function (Entry $entry) use ($callback) {
            return $callback ? call_user_func($callback, $entry->value) : !!$entry->value;
        });
    }

    /**
     * @param callable|null $callback
     * @return SequentialMultiMap
     */
    public function filterKeys(callable $callback = null)
    {
        return $this->filter(function (Entry $entry) use ($callback) {
            return $callback ? call_user_func($callback, $entry->key) : !!$entry->key;
        });
    }

    /**
     * @param callable $callback
     * @return SequentialMultiMap
     */
    public function filter(callable $callback)
    {
        return $this->entriesAt(
            $this->withKeys()
                ->values()
                ->filter($callback)
                ->map(function (Entry $entry) {
                    return $entry->offset;
                })
        );
    }

    
}
