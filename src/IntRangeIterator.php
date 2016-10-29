<?php

namespace ProjxIO\Collections;

use Iterator;

class IntRangeIterator implements Iterator
{
    /**
     * @var int
     */
    private $offset;

    /**
     * @var int
     */
    private $length;

    /**
     * @var int
     */
    private $current = 0;

    /**
     *
     * @param int $start
     * @param int $end
     */
    public function __construct($start, $end)
    {
        $this->offset = $start;
        $this->length = $start - $end;
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return $this->offset + $this->current;
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        $this->current++;
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return $this->current;
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return $this->current < $this->length;
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->current = 0;
    }
}
