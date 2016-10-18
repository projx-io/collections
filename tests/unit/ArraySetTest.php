<?php

namespace ProjxIO\Collections;

class ArraySetTest extends TestCase
{
    public function testConstruct()
    {
        $set = new ArraySet(['a', 'b']);
        $this->assertCount(2, $set);
    }

    public function testConstructDuplicates()
    {
        $set = new ArraySet(['a', 'a']);
        $this->assertCount(1, $set);
    }

    public function testCount0()
    {
        $set = new ArraySet([]);
        $this->assertCount(0, $set);
    }

    public function testCount1()
    {
        $set = new ArraySet(['a']);
        $this->assertCount(1, $set);
    }

    public function testContainsA()
    {
        $set = new ArraySet(['a']);
        $this->assertTrue($set->contains('a'));
    }

    public function testIntersectAll()
    {
        $set = new ArraySet(['a', 'b']);
        $this->assertCount(2, $set->intersect(['a', 'b']));
    }

    public function testIntersectSome()
    {
        $set = new ArraySet(['a', 'b']);
        $this->assertCount(1, $set->intersect(['c', 'b']));
    }

    public function testIntersectNone()
    {
        $set = new ArraySet(['a', 'b']);
        $this->assertCount(0, $set->intersect(['c', 'd']));
    }

    public function testContainsAllWithAll()
    {
        $set = new ArraySet(['a', 'b']);
        $this->assertTrue($set->containsAll(['a', 'b']));
    }

    public function testContainsAllWithSome()
    {
        $set = new ArraySet(['a', 'b']);
        $this->assertFalse($set->containsAll(['c', 'b']));
    }

    public function testContainsAllWithNone()
    {
        $set = new ArraySet(['a', 'b']);
        $this->assertFalse($set->containsAll(['c', 'd']));
    }

    public function testContainsAnyWithAny()
    {
        $set = new ArraySet(['a', 'b']);
        $this->assertTrue($set->containsAny(['a', 'b']));
    }

    public function testContainsAnyWithSome()
    {
        $set = new ArraySet(['a', 'b']);
        $this->assertTrue($set->containsAny(['c', 'b']));
    }

    public function testContainsAnyWithNone()
    {
        $set = new ArraySet(['a', 'b']);
        $this->assertFalse($set->containsAny(['c', 'd']));
    }

    public function testContainsNoneWithAll()
    {
        $set = new ArraySet(['a', 'b']);
        $this->assertFalse($set->containsNone(['a', 'b']));
    }

    public function testContainsNoneWithSome()
    {
        $set = new ArraySet(['a', 'b']);
        $this->assertFalse($set->containsNone(['c', 'b']));
    }

    public function testContainsNoneWithNone()
    {
        $set = new ArraySet(['a', 'b']);
        $this->assertTrue($set->containsNone(['c', 'd']));
    }

    public function testAddUnique()
    {
        $set = new ArraySet(['a']);
        $set->add('b');
        $this->assertCount(2, $set);
    }

    public function testAddDuplicate()
    {
        $set = new ArraySet(['a']);
        $set->add('a');
        $this->assertCount(1, $set);
    }

    public function testAddAllUniqueUnique()
    {
        $set = new ArraySet(['a']);
        $set->addAll(['b', 'c']);
        $this->assertCount(3, $set);
    }

    public function testAddAllDuplicateUnique()
    {
        $set = new ArraySet(['a']);
        $set->addAll(['a', 'c']);
        $this->assertCount(2, $set);
    }

    public function testAddAllDuplicateDuplicate()
    {
        $set = new ArraySet(['a']);
        $set->addAll(['a', 'a']);
        $this->assertCount(1, $set);
    }

    public function testRemoveContained()
    {
        $set = new ArraySet(['a', 'b']);
        $set->remove('b');
        $this->assertCount(1, $set);
    }

    public function testRemoveAbsent()
    {
        $set = new ArraySet(['a', 'b']);
        $set->remove('c');
        $this->assertCount(2, $set);
    }

    public function testRemoveAllContainedContained()
    {
        $set = new ArraySet(['a', 'b']);
        $set->removeAll(['a', 'b']);
        $this->assertCount(0, $set);
    }

    public function testRemoveAllContainedAbsent()
    {
        $set = new ArraySet(['a', 'b']);
        $set->removeAll(['c', 'b']);
        $this->assertCount(1, $set);
    }

    public function testRemoveAllAbsentAbsent()
    {
        $set = new ArraySet(['a', 'b']);
        $set->removeAll(['c', 'd']);
        $this->assertCount(2, $set);
    }

    public function testPlusUnique()
    {
        $set = new ArraySet(['a']);
        $actual = $set->plus('b');
        $this->assertCount(1, $set);
        $this->assertCount(2, $actual);
    }

    public function testPlusDuplicate()
    {
        $set = new ArraySet(['a']);
        $actual = $set->plus('a');
        $this->assertCount(1, $set);
        $this->assertCount(1, $actual);
    }

    public function testPlusAllUniqueUnique()
    {
        $set = new ArraySet(['a']);
        $actual = $set->plusAll(['b', 'c']);
        $this->assertCount(1, $set);
        $this->assertCount(3, $actual);
    }

    public function testPlusAllDuplicateUnique()
    {
        $set = new ArraySet(['a']);
        $actual = $set->plusAll(['a', 'c']);
        $this->assertCount(1, $set);
        $this->assertCount(2, $actual);
    }

    public function testPlusAllDuplicateDuplicate()
    {
        $set = new ArraySet(['a']);
        $actual = $set->plusAll(['a', 'a']);
        $this->assertCount(1, $set);
        $this->assertCount(1, $actual);
    }
}
