<?php

namespace ProjxIO\Collections;

use ProjxIO\Collections\Common\Stream;

class ValueStream implements Stream
{
    /**
     * @var mixed[]
     */
    private $values;

    /**
     *
     * @param mixed[] $values
     */
    public function __construct($values = [])
    {
        $this->values = $values;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {

    }

    /**
     * @inheritDoc
     */
    public function each(callable $callback)
    {

    }

    /**
     * @inheritDoc
     */
    public function map(callable $callback)
    {

    }

    /**
     * @inheritDoc
     */
    public function filter(callable $callback)
    {

    }

    /**
     * @inheritDoc
     */
    public function toSet()
    {

    }

    /**
     * @inheritDoc
     */
    public function toList()
    {

    }

    /**
     * @inheritDoc
     */
    public function toOneToOne()
    {

    }

    /**
     * @inheritDoc
     */
    public function toOneToMany()
    {

    }

    /**
     * @inheritDoc
     */
    public function toManyToOne()
    {

    }

    /**
     * @inheritDoc
     */
    public function toManyToMany()
    {

    }
}
