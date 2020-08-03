<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use JMac\Testing\Traits\AdditionalAssertions;
use Osiset\BasicShopifyAPI\Options;
use Tests\Stubs\Api as ApiStub;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, AdditionalAssertions;

    protected $fixturesPath = __DIR__ . '/fixtures/';

    protected function setApiStub(): void
    {
        $this->app['config']->set(
            'shopify-app.api_init',
            function (Options $opts): ApiStub {
                $ts = $this->app['config']->get('shopify-app.api_time_store');
                $ls = $this->app['config']->get('shopify-app.api_limit_store');
                $sd = $this->app['config']->get('shopify-app.api_deferrer');

                return new ApiStub(
                    $opts,
                    new $ts(),
                    new $ls(),
                    new $sd()
                );
            }
        );
    }

    /**
     * To test view composers
     * @param $view
     *
     * @return \Illuminate\Testing\TestResponse
     */
    protected function getRoutedView($view)
    {
        $route = '/phpunit/' . uniqid() . '/' . $view;

        resolve(\Illuminate\Routing\Router::class)->get($route, function () use ($view) {
            return view($view);
        });

        return $this->get($route);
    }
}
