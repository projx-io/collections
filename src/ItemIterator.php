<?php

namespace ProjxIO\Collections;

use ArrayIterator;

class ItemIterator extends ArrayIterator
{
    public function current()
    {
        return parent::current()->value();
    }

    public function key()
    {
        return parent::current()->key();
    }
}
