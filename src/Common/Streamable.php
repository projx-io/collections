<?php

namespace ProjxIO\Collections\Common;

use IteratorAggregate;

interface Streamable extends IteratorAggregate
{
    /**
     * @return Stream
     */
    public function stream();
}
