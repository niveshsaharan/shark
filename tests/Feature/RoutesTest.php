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
                'webhook', ['api', 'auth.webhook'], true,
            ],
            [
                'api.settings.get', ['api', 'auth:sanctum'], true,
            ],
            [
                'api.settings.save', ['api', 'auth:sanctum'], true,
            ],
        ];
    }
}
