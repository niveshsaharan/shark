<?php

namespace Tests\Feature\Vendor\Actions;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Osiset\ShopifyApp\Actions\AfterAuthorize;
use Osiset\ShopifyApp\Actions\AuthenticateShop;
use Osiset\ShopifyApp\Actions\AuthorizeShop;
use Osiset\ShopifyApp\Actions\DispatchScripts;
use Osiset\ShopifyApp\Actions\DispatchWebhooks;
use Osiset\ShopifyApp\Contracts\ApiHelper as IApiHelper;
use Osiset\ShopifyApp\Services\ShopSession;
use Tests\TestCase;

class AuthenticateShopTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function uses_correct_api_helper_config_for_public_app()
    {
        $action = new AuthenticateShop(resolve(ShopSession::class), resolve(IApiHelper::class), resolve(AuthorizeShop::class), resolve(DispatchScripts::class), resolve(DispatchWebhooks::class), resolve(AfterAuthorize::class));

        $class = new \ReflectionClass(get_class($action));
        $apiHelper = $class->getProperty('apiHelper');
        $apiHelper->setAccessible(true);
        $options = resolve(IApiHelper::class)->make()->getApi()->getOptions();

        $this->assertEquals($options, $apiHelper->getValue($action)->getApi()->getOptions());
    }

    /**
     * @test
     */
    public function uses_correct_api_helper_config_for_private_app()
    {
        $shop = factory(User::class)->create([
            'api_type' => 'private',
            'api_key' => 'key',
            'api_secret' => 'secret',
            'api_password' => 'password',
        ]);

        $shopSession = resolve(ShopSession::class);
        $shopSession->make($shop->getDomain());
        $action = new AuthenticateShop($shopSession, resolve(IApiHelper::class), resolve(AuthorizeShop::class), resolve(DispatchScripts::class), resolve(DispatchWebhooks::class), resolve(AfterAuthorize::class));

        $class = new \ReflectionClass(get_class($action));
        $apiHelper = $class->getProperty('apiHelper');
        $apiHelper->setAccessible(true);

        $options = resolve(IApiHelper::class)->make()->getApi()->getOptions();
        $options->setType(true);
        $options->setApiKey('key');
        $options->setApiPassword('password');
        $options->setApiSecret('secret');
        $this->assertEquals($options, $apiHelper->getValue($action)->getApi()->getOptions());
    }

    /**
     * @test
     */
    public function uses_correct_api_helper_config_for_custom_app()
    {
        $shop = factory(User::class)->create([
            'api_type' => 'custom',
            'api_key' => 'key',
            'api_secret' => 'secret',
        ]);

        $shopSession = resolve(ShopSession::class);
        $shopSession->make($shop->getDomain());
        $action = new AuthenticateShop($shopSession, resolve(IApiHelper::class), resolve(AuthorizeShop::class), resolve(DispatchScripts::class), resolve(DispatchWebhooks::class), resolve(AfterAuthorize::class));

        $class = new \ReflectionClass(get_class($action));
        $apiHelper = $class->getProperty('apiHelper');
        $apiHelper->setAccessible(true);

        $options = resolve(IApiHelper::class)->make()->getApi()->getOptions();
        $options->setApiKey('key');
        $options->setApiSecret('secret');
        $this->assertEquals($options, $apiHelper->getValue($action)->getApi()->getOptions());
    }
}
