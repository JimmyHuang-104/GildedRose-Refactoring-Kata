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

    public function getItems()
    {
        return $this->items;
    }

    private function updateAgedBrie($item)
    {
        if ($item->quality < 50) {
            $this->increaseQuality($item);
        }

        $item->sell_in = $item->sell_in - 1;

        if ($item->sell_in < 0 && $item->quality < 50) {
            $this->increaseQuality($item);
        }
    }

    private function updateSulfuras($item)
    {
    }

    private function updateBackstage($item)
    {
        if ($item->quality < 50) {
            $this->increaseQuality($item);
            if ($item->sell_in < 11 && $item->quality < 50) {
                $this->increaseQuality($item);
            }
            if ($item->sell_in < 6 && $item->quality < 50) {
                $this->increaseQuality($item);
            }
        }

        $item->sell_in = $item->sell_in - 1;

        if ($item->sell_in < 0) {
            $item->quality = $item->quality - $item->quality;
        }
    }

    private function update($item)
    {
        if ($item->quality > 0) {
            $this->decreaseQuality($item);
        }

        $item->sell_in = $item->sell_in - 1;

        if ($item->sell_in < 0 && $item->quality > 0) {
            $this->decreaseQuality($item);
        }
    }

    private function increaseQuality($item)
    {
        $item->quality = $item->quality + 1;
    }

    private function decreaseQuality($item)
    {
        $item->quality = $item->quality - 1;
    }
}
