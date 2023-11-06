<?php

namespace Tests\Unit\Models;

use App\Models\Plan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlanTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_extends_base_class()
    {
        $this->assertTrue(is_subclass_of(new Plan(), \Osiset\ShopifyApp\Storage\Models\Plan::class));
    }

    /**
     * @test
     * TODO Create factory and test with some test data
     */
    public function it_has_many_shops()
    {
        $plan = new Plan();

        $this->assertEquals(0, $plan->shops->count());
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $plan->shops);
    }
}
