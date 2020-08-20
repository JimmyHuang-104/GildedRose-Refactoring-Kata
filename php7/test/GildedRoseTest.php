<?php

namespace App;

class GildedRoseTest extends \PHPUnit\Framework\TestCase
{
    public function testFoo()
    {
        $item = new Item("foo", 0, 0);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals("foo", $item->getName());
    }


    public function testQualityNeverIsNegative()
    {
        $item = new Item("foo", 0, 0);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(0, $gildedRose->getItems()[0]->getQuality());
    }

    public function testSulfurasCouldNotBeSold()
    {
        $item = new Item("Sulfuras, Hand of Ragnaros", 10, 0);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(10, $gildedRose->getItems()[0]->getSellIn());
    }

    public function testSulfurasCouldNotDecreaseQuality()
    {
        $item = new Item("Sulfuras, Hand of Ragnaros", 10, 10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(10, $gildedRose->getItems()[0]->getQuality());
    }

    public function testQualityCouldNotBeMoreThanFifty()
    {
        $item = new Item("Aged Brie", 10, 50);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(50, $gildedRose->getItems()[0]->getQuality());
    }

    public function testItemWithDatePassedQualityDecreaseByTwice()
    {
        $item = new Item("foo", -1, 40);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(38, $gildedRose->getItems()[0]->getQuality());
    }

    public function testAgedBrieIncreaseQualityWhenItGetsOlder()
    {
        $item = new Item("Aged Brie", 1, 40);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(41, $gildedRose->getItems()[0]->getQuality());
    }

    public function testAgedBrieIncreaseByTwoQualityWhenDatePassed()
    {
        $item = new Item("Aged Brie", -1, 40);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(42, $gildedRose->getItems()[0]->getQuality());
    }

    public function testAgedBrieIncreaseByTwoQualityWhenDatePassedAndNotMoreThanFifty()
    {
        $item = new Item("Aged Brie", -1, 50);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(50, $gildedRose->getItems()[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByTwoWhenSellinLessThanTen()
    {
        $item = new Item("Backstage passes to a TAFKAL80ETC concert", 10, 40);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(42, $gildedRose->getItems()[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByTwoWhenSellinLessThanSix()
    {
        $item = new Item("Backstage passes to a TAFKAL80ETC concert", 6, 40);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(42, $gildedRose->getItems()[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByThreeWhenSellinLessThanFive()
    {
        $item = new Item("Backstage passes to a TAFKAL80ETC concert", 5, 40);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(43, $gildedRose->getItems()[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByTwoWhenSellinLessThanSixAndNotMoreThanFifty()
    {
        $item = new Item("Backstage passes to a TAFKAL80ETC concert", 6, 49);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(50, $gildedRose->getItems()[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByThreeWhenSellinLessThanFiveAndNotMoreThanFifty()
    {
        $item = new Item("Backstage passes to a TAFKAL80ETC concert", 5, 48);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(50, $gildedRose->getItems()[0]->getQuality());
    }

    public function testBackstagePassesQualityDropsToZeroAfterConcert()
    {
        $item = new Item("Backstage passes to a TAFKAL80ETC concert", 0, 40);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(0, $gildedRose->getItems()[0]->getQuality());
    }

    public function testBackstagePassesQualityIncreaseQuilityByOneQhenDateIsMoreThan10()
    {
        $item = new Item("Backstage passes to a TAFKAL80ETC concert", 11, 40);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(41, $gildedRose->getItems()[0]->getQuality());
    }
}
