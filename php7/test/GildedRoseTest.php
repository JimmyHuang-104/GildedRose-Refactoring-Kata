<?php

namespace App;

use App\Item\ItemFactory;

class GildedRoseTest extends \PHPUnit\Framework\TestCase
{
    public function testFoo()
    {
        $item = ItemFactory::create("foo", 0, 0);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals("foo", $item->getName());
    }


    public function testQualityNeverIsNegative()
    {
        $item = ItemFactory::create("foo", 0, 0);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(0, $gildedRose->getItems()[0]->getQuality());
    }

    public function testSulfurasCouldNotBeSold()
    {
        $item = ItemFactory::create("Sulfuras, Hand of Ragnaros", 10, 0);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(10, $gildedRose->getItems()[0]->getSellIn());
    }

    public function testSulfurasCouldNotDecreaseQuality()
    {
        $item = ItemFactory::create("Sulfuras, Hand of Ragnaros", 10, 10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(10, $gildedRose->getItems()[0]->getQuality());
    }

    public function testQualityCouldNotBeMoreThanFifty()
    {
        $item = ItemFactory::create("Aged Brie", 10, 50);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(50, $gildedRose->getItems()[0]->getQuality());
    }

    public function testItemWithDatePassedQualityDecreaseByTwice()
    {
        $item = ItemFactory::create("foo", -1, 40);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(38, $gildedRose->getItems()[0]->getQuality());
    }

    public function testAgedBrieIncreaseQualityWhenItGetsOlder()
    {
        $item = ItemFactory::create("Aged Brie", 1, 40);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(41, $gildedRose->getItems()[0]->getQuality());
    }

    public function testAgedBrieIncreaseByTwoQualityWhenDatePassed()
    {
        $item = ItemFactory::create("Aged Brie", -1, 40);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(42, $gildedRose->getItems()[0]->getQuality());
    }

    public function testAgedBrieIncreaseByTwoQualityWhenDatePassedAndNotMoreThanFifty()
    {
        $item = ItemFactory::create("Aged Brie", -1, 50);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(50, $gildedRose->getItems()[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByTwoWhenSellinLessThanTen()
    {
        $item = ItemFactory::create("Backstage passes to a TAFKAL80ETC concert", 10, 40);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(42, $gildedRose->getItems()[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByTwoWhenSellinLessThanSix()
    {
        $item = ItemFactory::create("Backstage passes to a TAFKAL80ETC concert", 6, 40);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(42, $gildedRose->getItems()[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByThreeWhenSellinLessThanFive()
    {
        $item = ItemFactory::create("Backstage passes to a TAFKAL80ETC concert", 5, 40);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(43, $gildedRose->getItems()[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByTwoWhenSellinLessThanSixAndNotMoreThanFifty()
    {
        $item = ItemFactory::create("Backstage passes to a TAFKAL80ETC concert", 6, 49);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(50, $gildedRose->getItems()[0]->getQuality());
    }

    public function testBackstagePassesIncreaseQualityByThreeWhenSellinLessThanFiveAndNotMoreThanFifty()
    {
        $item = ItemFactory::create("Backstage passes to a TAFKAL80ETC concert", 5, 48);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(50, $gildedRose->getItems()[0]->getQuality());
    }

    public function testBackstagePassesQualityDropsToZeroAfterConcert()
    {
        $item = ItemFactory::create("Backstage passes to a TAFKAL80ETC concert", 0, 40);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(0, $gildedRose->getItems()[0]->getQuality());
    }

    public function testBackstagePassesQualityIncreaseQuilityByOneQhenDateIsMoreThan10()
    {
        $item = ItemFactory::create("Backstage passes to a TAFKAL80ETC concert", 11, 40);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(41, $gildedRose->getItems()[0]->getQuality());
    }
}
