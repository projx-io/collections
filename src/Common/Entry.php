<?php

namespace ProjxIO\Collections\Common;

/**
 * @package Test
 */
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
