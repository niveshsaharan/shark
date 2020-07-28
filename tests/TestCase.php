<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use JMac\Testing\Traits\AdditionalAssertions;
use Osiset\BasicShopifyAPI\Options;
use Tests\Stubs\Api as ApiStub;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, AdditionalAssertions;

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
}
