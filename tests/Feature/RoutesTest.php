<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Class RoutesTest
 *
 * @package \Tests\Feature
 */
class RoutesTest extends TestCase
{
    /**
     * @test
     */
    public function it_has_home_route_and_uses_correct_middlewares()
    {
        $this->assertRouteUsesMiddleware('home', ['web', 'auth.shopify'], true);
    }

    /**
     * @test
     */
    public function webhook_route_uses_correct_middlewares()
    {
        $this->assertRouteUsesMiddleware('webhook', ['api', 'auth.webhook'], true);
    }
}
