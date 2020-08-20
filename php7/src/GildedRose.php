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
            switch ($item->getName()) {
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
    public function getItems(): array
    {
        return $this->items;
    }

    private function updateAgedBrie(Item $item)
    {
        $item->increaseQuality();

        $item->decreaseSellIn();

        if ($item->getSellIn() < 0) {
            $item->increaseQuality();
        }
    }

    private function updateSulfuras(Item $item)
    {
    }

    private function updateBackstage(Item $item)
    {
        $item->increaseQuality();

        if ($item->getSellIn() < 11) {
            $item->increaseQuality();
        }
        if ($item->getSellIn() < 6) {
            $item->increaseQuality();
        }

        $item->decreaseSellIn();

        if ($item->getSellIn() < 0) {
            $item->setQuality(0);
        }
    }

    private function update(Item $item)
    {
        $item->decreaseQuality();

        $item->decreaseSellIn();

        if ($item->getSellIn() < 0) {
            $item->decreaseQuality();
        }
    }
}
