<?php

namespace ProjxIO\Collections\Types;

interface Methods
{
    public function offsetsOfValues($values);
    public function offsetsOfKeys($keys);
    public function offsetsOfEntries($entries);

    public function entriesAtOffsets($offsets);
    public function valuesAtOffsets($offsets);
    public function keysAtOffsets($offsets);

    public function valuesOfKeys($keys);
    public function keysOfValues($values);
    public function entriesOfValues($values);
    public function entriesOfKeys($keys);
}
