<?php

namespace App;

class ItemTest extends \PHPUnit\Framework\TestCase
{
    public function testToString()
    {
        $item = new Item("foo", 0, 0);
        $this->assertEquals("foo, 0, 0", $item->__toString());
    }
}
