<?php

namespace App\Item;

class NormalItem extends Item
{
    public function update()
    {
        $this->decreaseQuality();

        $this->decreaseSellIn();

        if ($this->getSellIn() < 0) {
            $this->decreaseQuality();
        }
    }
}
