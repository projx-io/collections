<?php

namespace ProjxIO\Collections\Common;

interface SequentialEntry extends Entry
{
    /**
     * @return int
     */
    public function offset();
}