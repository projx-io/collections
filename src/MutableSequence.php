<?php

namespace ProjxIO\Collections;

interface MutableSequence extends Sequence
{
    /**
     * @param integer $offset
     * @param mixed $value
     */
    public function set($offset, $value);

    /**
     * @param integer $offset
     * @param mixed $value
     */
    public function insert($offset, $value);

    /**
     * @param integer $offset
     * @param mixed $values
     */
    public function insertAll($offset, $values);

    /**
     * @param $value
     */
    public function pushFront($value);

    /**
     * @param $values
     */
    public function pushFrontAll($values);

    /**
     * @param $value
     */
    public function pushBack($value);

    /**
     * @param $values
     */
    public function pushBackAll($values);

    /**
     * @param $value
     */
    public function remove($value);

    /**
     * @param $values
     */
    public function removeAll($values);

    /**
     * @param $value
     */
    public function removeFirst($value);

    /**
     * @param $values
     */
    public function removeFirstAll($values);

    /**
     * @param $value
     */
    public function removeLast($value);

    /**
     * @param $values
     */
    public function removeLastAll($values);
}
