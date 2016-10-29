<?php
//
//namespace ProjxIO\Collections\Common;
//
//use ProjxIO\Collections\EntryItem;
//use ProjxIO\Collections\TestCase;
//
//class FromOneTest extends TestCase
//{
//    /**
//     * @dataProvider collectionProviderTest
//     * @param FromOne $collection
//     */
//    public function testOffsetOfValue(FromOne $collection)
//    {
//        $this->assertEquals([0, 3], $collection->offsetOfValue('X'));
//    }
//
//    /**
//     * @dataProvider collectionProviderTest
//     * @param FromOne $collection
//     */
//    public function testOffsetOfValues(FromOne $collection)
//    {
//        $this->assertEquals([[0, 3], [2, 5]], $collection->offsetOfValues(['X', 'Z']));
//    }
//
//    /**
//     * @dataProvider collectionProviderTest
//     * @param FromOne $collection
//     */
//    public function testKeyOfValue(FromOne $collection)
//    {
//        $this->assertEquals(['A', 'D'], $collection->keyOfValue('X'));
//    }
//
//    /**
//     * @dataProvider collectionProviderTest
//     * @param FromOne $collection
//     */
//    public function testKeyOfValues(FromOne $collection)
//    {
//        $this->assertEquals([['A', 'D'], ['C', 'B']], $collection->keyOfValues(['X', 'Z']));
//    }
//
//    /**
//     * @dataProvider collectionProviderTest
//     * @param FromOne $collection
//     */
//    public function testItemOfValue(FromOne $collection)
//    {
//        $items = [
//            new EntryItem('A', 'X'),
//            new EntryItem('D', 'X'),
//        ];
//
//        $this->assertItems($items, $collection->itemOfValue('X'));
//    }
//
//    /**
//     * @dataProvider collectionProviderTest
//     * @param FromOne $collection
//     */
//    public function testItemOfValues(FromOne $collection)
//    {
//        $items = [
//            [
//                new EntryItem('A', 'X'),
//                new EntryItem('D', 'X'),
//            ],
//            [
//                new EntryItem('C', 'Z'),
//                new EntryItem('B', 'Z'),
//            ],
//        ];
//
//        $this->assertItems($items, $collection->itemOfValues(['X', 'Z']));
//    }
//}
