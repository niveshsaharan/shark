<?php

namespace Tests\Unit\Providers;

use App\Providers\ViewServiceProvider;
use Tests\TestCase;

/**
 * Class ViewServiceProviderTest
 *
 * @package \Tests\Unit\Providers
 */
class ViewServiceProviderTest extends TestCase
{
    /**
     * @test
     */
    public function it_is_registered()
    {
        $provider = ViewServiceProvider::class;
        $this->assertNotSame([], app()->getProviders($provider), "Service Provider `$provider` is not registered.");
    }
}
