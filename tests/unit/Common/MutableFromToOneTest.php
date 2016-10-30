<?php

namespace ProjxIO\Collections\Common;

use ProjxIO\Collections\TestCase;

class MutableFromToOneTest extends TestCase
{
    /**
     * @dataProvider collectionProviderTest
     * @param MutableFromToOne $collection
     * @param mixed[] $v
     * @param mixed[][] $ks
     * @param mixed[] $k
     * @param mixed[][] $vs
     */
    public function testRemoveEntry(MutableFromToOne $collection, $v, $ks, $k, $vs)
    {
        $this->assertTrue($collection->containsEntry($k[0], $v[0]));
        $collection->removeEntry($k[0], $v[0]);
        $this->assertFalse($collection->containsEntry($k[0], $v[0]));
    }
}
