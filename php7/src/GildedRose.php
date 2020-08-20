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
            $item->update();
        }
    }

    /**
     * @return App\Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
