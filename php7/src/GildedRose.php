<?php

namespace App;

final class GildedRose
{

    private $items = [];

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function updateQuality()
    {
        $items = $this->getItems();
        foreach ($items as $item) {
            switch ($item->name) {
                case 'Aged Brie':
                    $this->updateAgedBrie($item);
                    break;
                case 'Sulfuras, Hand of Ragnaros':
                    $this->updateSulfuras($item);
                    break;
                case 'Backstage passes to a TAFKAL80ETC concert':
                    $this->updateBackstage($item);
                    break;
                default:
                    $this->update($item);
            }
        }
    }

    /**
     * @return Item[]
     */
    public function getItems()
    {
        return $this->items;
    }

    private function updateAgedBrie($item)
    {
        $item->increaseQuality();

        $item->decreaseSellIn();

        if ($item->sell_in < 0) {
            $item->increaseQuality();
        }
    }

    private function updateSulfuras($item)
    {
    }

    private function updateBackstage($item)
    {
        $item->increaseQuality();

        if ($item->sell_in < 11) {
            $item->increaseQuality();
        }
        if ($item->sell_in < 6) {
            $item->increaseQuality();
        }

        $item->decreaseSellIn();

        if ($item->sell_in < 0) {
            $item->noQuality();
        }
    }

    private function update($item)
    {
        $item->decreaseQuality();

        $item->decreaseSellIn();

        if ($item->sell_in < 0) {
            $item->decreaseQuality();
        }
    }
}
