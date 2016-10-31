<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class IterableTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param Iterable $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testGetIterator(Iterable $collection, $v, $vs, $k, $ks)
    {
        $i = 0;
        foreach ($collection as $key => $value) {
            $this->assertEquals($v[$i], $value);
            $this->assertEquals($k[$i], $key);
            $i++;
        }
    }

    /**
     * @dataProvider collectionProviderTest
     * @param Iterable $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testStream(Iterable $collection, $v, $vs, $k, $ks)
    {
        $this->assertInstanceOf(Stream::class, $collection->stream());
    }
}
