<?php

namespace ProjxIO\Collections;

use IteratorAggregate;

class IntRange implements IteratorAggregate
{
    /**
     * @var int
     */
    private $start;

    /**
     * @var int
     */
    private $end;

    /**
     *
     * @param int $start
     * @param int $end
     */
    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new IntRangeIterator($this->start, $this->end);
    }

    /**
     * @return int
     */
    public function start()
    {
        return $this->start;
    }

    /**
     * @return int
     */
    public function end()
    {
        return $this->end;
    }
}
