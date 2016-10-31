<?php

namespace ProjxIO\Collections\Common;

use IteratorAggregate;

interface Iterable extends IteratorAggregate
{
    /**
     * @return Stream
     */
    public function stream();
}
