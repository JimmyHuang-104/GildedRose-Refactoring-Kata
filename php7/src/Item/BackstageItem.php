<?php

namespace App\Item;

class BackstageItem extends Item
{
    public function update()
    {
        $this->increaseQuality();

        if ($this->getSellIn() < 11) {
            $this->increaseQuality();
        }
        if ($this->getSellIn() < 6) {
            $this->increaseQuality();
        }

        $this->decreaseSellIn();

        if ($this->getSellIn() < 0) {
            $this->setQuality(0);
        }
    }
}
