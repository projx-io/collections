<?php

namespace ProjxIO\Collections\Common;

interface Entry
{
    /**
     * @return mixed
     */
    public function key();

    /**
     * @return mixed
     */
    public function value();
}