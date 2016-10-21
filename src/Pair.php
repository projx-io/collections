<?php

namespace ProjxIO\Collections;

class Pair implements Entry
{
    /**
     * @var mixed
     */
    public $key;

    /**
     * @var mixed
     */
    public $value;

    /**
     * @var int
     */
    public $offset;

    /**
     *
     * @param mixed $key
     * @param mixed $value
     * @param int $offset
     */
    public function __construct($key, $value, $offset)
    {
        $this->key = $key;
        $this->value = $value;
        $this->offset = $offset;
    }
}
