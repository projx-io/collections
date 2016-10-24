<?php

namespace ProjxIO\Collections\Common;

interface SequentialItemSet extends SequentialItemCollection
{
    /**
     * @param Entry $item
     * @return int
     */
    public function offsetOfItem(Entry $item);
}
