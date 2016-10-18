<?php

namespace ProjxIO\Collections;

use Exception;
use PHPUnit_Framework_TestCase;

class TestCase extends PHPUnit_Framework_TestCase
{
    public function assertThrows($class, callable $callback, array $params = [])
    {
        $error = null;
        try {
            call_user_func_array($callback, $params);
        } catch (Exception $e) {
            $error = $e;
        }

        $this->assertInstanceOf($class, $error, 'Failed asserting that exception of type ' . $class . ' is thrown.');
    }
}