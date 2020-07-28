<?php

namespace Tests\Unit\Providers;

use App\Formatters\ShopApiResponseFormatter;
use Tests\TestCase;

class AppServiceProviderTest extends TestCase
{
    /**
     * @test
     */
    public function it_binds_shop_api_response_formatter_As_singleton()
    {
        $expected = resolve(ShopApiResponseFormatter::class);

        $this->assertSame($expected, resolve(ShopApiResponseFormatter::class));
    }
}
