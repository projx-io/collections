<?php

namespace ProjxIO\Collections\Common;

use Countable;

interface ValueCollection extends Countable, Streamable
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function containsValue($value);

    /**
     * @param int $offset
     * @return mixed
     */
    public function valueOfOffset($offset);

    /**
     * @param int[] $offsets
     * @return mixed[]
     */
    public function valueOfOffsets($offsets);
}
