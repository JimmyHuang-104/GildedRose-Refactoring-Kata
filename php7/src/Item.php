<?php

namespace App;

final class Item
{

    public $name;
    public $sell_in;
    public $quality;

    function __construct($name, $sell_in, $quality)
    {
        $this->name    = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString()
    {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

    public function increaseQuality()
    {
        if ($this->quality < 50) {
            $this->quality = $this->quality + 1;
        }
    }

    public function decreaseQuality()
    {
        if ($this->quality > 0) {
            $this->quality = $this->quality - 1;
        }
    }

    public function noQuality()
    {
        $this->quality = 0;
    }

    public function decreaseSellIn()
    {
        $this->sell_in = $this->sell_in - 1;
    }
}
