<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Class RoutesTest
 *
 * @package \Tests\Feature
 */
class AllRoutesTest extends TestCase
{
    /**
     * @test
     * @dataProvider routes_middewares
     */
    public function routes_uses_middlewares($route, $middelwares, $exact = false)
    {
        $this->assertRouteUsesMiddleware($route, $middelwares, $exact);
    }

    /**
     * Routes and Middlewares mappings
     * @return array[]
     */
    public function routes_middewares()
    {
        return [
            [
                'home', ['web', 'auth.shopify'], true,
            ],
            [
                'setting.index', ['web', 'auth.shopify'], true,
            ],
            [
                'setting.update', ['web', 'auth.shopify'], true,
            ],
            [
                'horizon.index', ['web', 'admin'],
            ],
            [
                'appstore', ['web'], true,
            ],
            [
                'webhook', ['web', 'auth.webhook'], true,
            ],
        ];
    }
}
