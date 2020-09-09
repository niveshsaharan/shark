<?php

namespace Tests\Unit;

use App\Charge;
use PHPUnit\Framework\TestCase;

class ChargeTest extends TestCase
{
    /**
     * @test
     */
    public function it_extends_base_class()
    {
        $this->assertTrue(is_subclass_of(new Charge(), \Osiset\ShopifyApp\Storage\Models\Charge::class));
    }
}