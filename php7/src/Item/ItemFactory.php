<?php

namespace App\Item;

final class ItemFactory
{
    static public function create($name, $sell_in, $quality)
    {
        switch ($name) {
            case 'Aged Brie':
                return new AgedBrieItem($name, $sell_in, $quality);
            case 'Sulfuras, Hand of Ragnaros':
                return new SulfurasItem($name, $sell_in, $quality);
            case 'Backstage passes to a TAFKAL80ETC concert':
                return new BackstageItem($name, $sell_in, $quality);
            default:
                return new NormalItem($name, $sell_in, $quality);
        }
    }
}
