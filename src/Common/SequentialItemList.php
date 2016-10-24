<?php

namespace ProjxIO\Collections\Common;

interface SequentialItemList extends SequentialItemCollection
{
    /**
     * @param Entry $item
     * @return int[]
     */
    public function offsetsOfItem(Entry $item);
}