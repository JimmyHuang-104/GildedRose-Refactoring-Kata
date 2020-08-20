<?php

namespace App;

use App\Item\NormalItem;

class NormalItemTest extends \PHPUnit\Framework\TestCase
{
    public function testToString()
    {
        $item = new NormalItem("foo", 0, 0);
        $this->assertEquals("foo, 0, 0", $item->__toString());
    }
}
