<?php

namespace Tests\Feature\Vendor\Middleware;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Osiset\ShopifyApp\Contracts\ApiHelper as IApiHelper;
use Osiset\ShopifyApp\Contracts\Queries\Shop as IShopQuery;
use Osiset\ShopifyApp\Http\Middleware\AuthShopify as AuthShopifyMiddleware;
use Osiset\ShopifyApp\Services\ShopSession;
use Tests\TestCase;

class AuthShopifyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function uses_correct_api_helper_config_for_public_app()
    {
        $middleware = new AuthShopifyMiddleware(resolve(IApiHelper::class), resolve(ShopSession::class), resolve(IShopQuery::class));

        $class = new \ReflectionClass(get_class($middleware));
        $apiHelper = $class->getProperty('apiHelper');
        $apiHelper->setAccessible(true);
        $options = resolve(IApiHelper::class)->make()->getApi()->getOptions();

        $this->assertEquals($options, $apiHelper->getValue($middleware)->getApi()->getOptions());
    }

    /**
     * @test
     */
    public function uses_correct_api_helper_config_for_private_app()
    {
        $shop = User::factory()->create([
            'api_type' => 'private',
            'api_key' => 'key',
            'api_secret' => 'secret',
            'api_password' => 'password',
        ]);

        $shopSession = resolve(ShopSession::class);
        $shopSession->make($shop->getDomain());
        $middleware = new AuthShopifyMiddleware(resolve(IApiHelper::class), $shopSession, resolve(IShopQuery::class));

        $class = new \ReflectionClass(get_class($middleware));
        $apiHelper = $class->getProperty('apiHelper');
        $apiHelper->setAccessible(true);

        $options = resolve(IApiHelper::class)->make()->getApi()->getOptions();
        $options->setType(true);
        $options->setApiKey('key');
        $options->setApiPassword('password');
        $options->setApiSecret('secret');
        $this->assertEquals($options, $apiHelper->getValue($middleware)->getApi()->getOptions());
    }

    /**
     * @test
     */
    public function uses_correct_api_helper_config_for_custom_app()
    {
        $shop = User::factory()->create([
            'api_type' => 'custom',
            'api_key' => 'key',
            'api_secret' => 'secret',
        ]);

        $shopSession = resolve(ShopSession::class);
        $shopSession->make($shop->getDomain());
        $middleware = new AuthShopifyMiddleware(resolve(IApiHelper::class), $shopSession, resolve(IShopQuery::class));

        $class = new \ReflectionClass(get_class($middleware));
        $apiHelper = $class->getProperty('apiHelper');
        $apiHelper->setAccessible(true);

        $options = resolve(IApiHelper::class)->make()->getApi()->getOptions();
        $options->setApiKey('key');
        $options->setApiSecret('secret');
        $this->assertEquals($options, $apiHelper->getValue($middleware)->getApi()->getOptions());
    }
}
