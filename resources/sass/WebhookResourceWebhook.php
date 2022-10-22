<?php

namespace App\Models;

use App\Formatters\ShopApiResponseFormatter;
use App\Formatters\ShopWebhookResponseFormatter;
use Glorand\Model\Settings\Traits\HasSettingsTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Osiset\BasicShopifyAPI\ResponseAccess;
use Osiset\ShopifyApp\Contracts\ApiHelper as IApiHelper;
use Osiset\ShopifyApp\Contracts\ShopModel as IShopModel;
use Osiset\ShopifyApp\Traits\ShopModel;

class User extends Authenticatable implements IShopModel
{
    use Notifiable,
        HasApiTokens,
        HasSettingsTable,
        HasFactory;
    use ShopModel {
        apiHelper as originalApiHelper;
    }

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'presentment_currencies' => 'json',
        'shopify_scopes' => 'json',
        'shopify_partner' => 'boolean',
        'shopify_plus' => 'boolean',
        'metadata' => 'json',
    ];

    /**
     * Update from api response
     *
     * @param \Osiset\BasicShopifyAPI\ResponseAccess $response
     *
     * @return bool
     */
    public function updateFromGraphApiResponse(ResponseAccess $response)
    {
        $response = app(ShopApiResponseFormatter::class)->format($response);

        return $this->update($response);
    }

    /**
     * Update from api response
     *
     * @param $data \stdClass
     *
     * @return bool
     */
    public function updateFromWebhook(\stdClass $data)
    {
        $response = app(ShopWebhookResponseFormatter::class)->format($data);

        return $this->update($response);
    }

    /**
     * Check if shop is using a public app
     * @return bool
     */
    public function isUsingPublicApp()
    {
        return $this->api_type === 'public' || ! ($this->isUsingPrivateApp() || $this->isUsingCustomApp());
    }

    /**
     * Check if shop is using a private app
     * @return bool
     */
    public function isUsingPrivateApp()
    {
        return $this->api_type === 'private' && $this->api_key && $this->api_secret && $this->api_password;
    }

    /**
     * Check if shop is using a custom app
     * @return bool
     */
    public function isUsingCustomApp()
    {
        return $this->api_type === 'custom' && $this->api_key && $this->api_secret;
    }

    /**
     * Check if shop is using embed version of app
     * @return bool
     */
    public function isUsingEmbeddedApp()
    {
        return config('shopify-app.appbridge_enabled')
            && $this->api()->getOptions()->isPrivate() === false
            && request()->query('standalone') != 1
            && ! (request()->hasSession() && request()->session()->get('standalone'))
            && ! app('impersonate')->isImpersonating();
    }

    /**
     * Shop can be a tester
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tester()
    {
        return $this->hasOne(Tester::class, 'shopify_domain', 'shopify_domain');
    }

    /**
     * {@inheritdoc}
     */
    public function isTester(): bool
    {
        return in_array($this->shopify_plan_display_name, config('shark.tester_plans'))
            || in_array($this->getDomain()->toNative(), config('shark.tester_shops'))
            || ($this->shopify_partner && config('shark.shopify_partner_as_tester') === true)
            || $this->tester()->active()->count() > 0;
    }

    /**
     * Overwrite configuration to use Public/Private/Custom app
     * @return \Osiset\ShopifyApp\Contracts\ApiHelper
     */
    public function apiHelper(): IApiHelper
    {
        $apiHelper = $this->originalApiHelper();

        $opts = $apiHelper->getApi()->getOptions();

        if ($this->isUsingPrivateApp()) {
            $opts->setApiKey($this->api_key);
            $opts->setApiSecret($this->api_secret);
            $opts->setApiPassword($this->api_password);
            $opts->setType(true);
        } elseif ($this->isUsingCustomApp()) {
            $opts = $apiHelper->getApi()->getOptions();
            $opts->setApiKey($this->api_key);
            $opts->setApiSecret($this->api_secret);
            $opts->setType(false);
        }

        $apiHelper->getApi()->setOptions($opts);

        return $apiHelper;
    }
}
