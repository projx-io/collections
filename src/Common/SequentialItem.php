<?php

namespace ProjxIO\Collections\Common;

class SequentialItem extends Item implements SequentialEntry
{
    /**
     * @var int
     */
    private $offset;

    /**
     *
     * @param mixed $key
     * @param mixed $value
     * @param int $offset
     */
    public function __construct($key, $value, $offset)
    {
        parent::__construct($key, $value);
        $this->offset = $offset;
    }

    /**
     * @inheritDoc
     */
    public function offset()
    {
        return $this->offset;
    }
}
