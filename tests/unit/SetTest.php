<?php

namespace ProjxIO\Collections;

class SetTest extends TestCase
{
    public function setProvider()
    {
        $every = ['a', 'b'];
        $some = ['b', 'c'];
        $missing = ['c', 'd'];
        return [
            [new ArraySet($every), $every, $some, $missing],
            [new MutableArraySet($every), $every, $some, $missing],
        ];
    }

    /**
     * @dataProvider setProvider
     * @param Set $set
     * @param array $every
     * @param array $some
     * @param array $missing
     */
    public function testCount(Set $set, array $every, array $some, array $missing)
    {
        $this->assertCount(count($every), $set);
    }

    /**
     * @dataProvider setProvider
     * @param Set $set
     * @param array $every
     * @param array $some
     * @param array $missing
     */
    public function testContainsTrue(Set $set, array $every, array $some, array $missing)
    {
        foreach ($every as $value) {
            $this->assertTrue($set->contains($value));
        }
    }

    /**
     * @dataProvider setProvider
     * @param Set $set
     * @param array $every
     * @param array $some
     * @param array $missing
     */
    public function testContainsFalse(Set $set, array $every, array $some, array $missing)
    {
        foreach ($missing as $value) {
            $this->assertFalse($set->contains($value));
        }
    }

    /**
     * @dataProvider setProvider
     * @param Set $set
     * @param array $every
     * @param array $some
     * @param array $missing
     */
    public function testIntersectEvery(Set $set, array $every, array $some, array $missing)
    {
        $this->assertCount(count($every), $set->intersect($every));
    }

    /**
     * @dataProvider setProvider
     * @param Set $set
     * @param array $every
     * @param array $some
     * @param array $missing
     */
    public function testIntersectSome(Set $set, array $every, array $some, array $missing)
    {
        $this->assertNotCount(count($every), $set->intersect($some));
        $this->assertGreaterThan(0, $set->intersect($some)->count());
    }

    /**
     * @dataProvider setProvider
     * @param Set $set
     * @param array $every
     * @param array $some
     * @param array $missing
     */
    public function testIntersectNone(Set $set, array $every, array $some, array $missing)
    {
        $this->assertCount(0, $set->intersect($missing));
    }

    /**
     * @dataProvider setProvider
     * @param Set $set
     * @param array $every
     * @param array $some
     * @param array $missing
     */
    public function testContainsAllWithEvery(Set $set, array $every, array $some, array $missing)
    {
        $this->assertTrue($set->containsAll($every));
    }

    /**
     * @dataProvider setProvider
     * @param Set $set
     * @param array $every
     * @param array $some
     * @param array $missing
     */
    public function testContainsAllWithSome(Set $set, array $every, array $some, array $missing)
    {
        $this->assertFalse($set->containsAll($some));
    }

    /**
     * @dataProvider setProvider
     * @param Set $set
     * @param array $every
     * @param array $some
     * @param array $missing
     */
    public function testContainsAllWithMissing(Set $set, array $every, array $some, array $missing)
    {
        $this->assertFalse($set->containsAll($missing));
    }

    /**
     * @dataProvider setProvider
     * @param Set $set
     * @param array $every
     * @param array $some
     * @param array $missing
     */
    public function testContainsAnyWithEvery(Set $set, array $every, array $some, array $missing)
    {
        $this->assertTrue($set->containsAny($every));
    }

    /**
     * @dataProvider setProvider
     * @param Set $set
     * @param array $every
     * @param array $some
     * @param array $missing
     */
    public function testContainsAnyWithSome(Set $set, array $every, array $some, array $missing)
    {
        $this->assertTrue($set->containsAny($some));
    }

    /**
     * @dataProvider setProvider
     * @param Set $set
     * @param array $every
     * @param array $some
     * @param array $missing
     */
    public function testContainsAnyWithMissing(Set $set, array $every, array $some, array $missing)
    {
        $this->assertFalse($set->containsAny($missing));
    }

    /**
     * @dataProvider setProvider
     * @param Set $set
     * @param array $every
     * @param array $some
     * @param array $missing
     */
    public function testContainsNoneWithEvery(Set $set, array $every, array $some, array $missing)
    {
        $this->assertFalse($set->containsNone($every));
    }

    /**
     * @dataProvider setProvider
     * @param Set $set
     * @param array $every
     * @param array $some
     * @param array $missing
     */
    public function testContainsNoneWithSome(Set $set, array $every, array $some, array $missing)
    {
        $this->assertFalse($set->containsNone($some));
    }

    /**
     * @dataProvider setProvider
     * @param Set $set
     * @param array $every
     * @param array $some
     * @param array $missing
     */
    public function testContainsNoneWithMissing(Set $set, array $every, array $some, array $missing)
    {
        $this->assertTrue($set->containsNone($missing));
    }

    /**
     * @dataProvider setProvider
     * @param Set $set
     * @param array $every
     * @param array $some
     * @param array $missing
     */
    public function testPlusAll(Set $set, array $every, array $some, array $missing)
    {
        $a = $set->plusAll($every)->count();
        $b = $set->plusAll($some)->count();
        $c = $set->plusAll($missing)->count();

        $low = count($set);
        $high = count($set) + count($missing);

        $this->assertEquals($low, $a);
        $this->assertGreaterThan($low, $b);
        $this->assertLessThan($high, $b);
        $this->assertEquals($high, $c);
    }

    /**
     * @dataProvider setProvider
     * @param Set $set
     * @param array $every
     * @param array $some
     * @param array $missing
     */
    public function testMinusAll(Set $set, array $every, array $some, array $missing)
    {
        $a = $set->minusAll($every)->count();
        $b = $set->minusAll($some)->count();
        $c = $set->minusAll($missing)->count();

        $low = 0;
        $high = count($set);

        $this->assertEquals($low, $a);
        $this->assertGreaterThan($low, $b);
        $this->assertLessThan($high, $b);
        $this->assertEquals($high, $c);
    }
}
