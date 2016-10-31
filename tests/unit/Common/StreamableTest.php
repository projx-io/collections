<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class StreamableTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param Streamable $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testGetIterator(Streamable $collection, $v, $vs, $k, $ks)
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
     * @param Streamable $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testStream(Streamable $collection, $v, $vs, $k, $ks)
    {
        $this->assertInstanceOf(Stream::class, $collection->stream());
    }
}
