<?php

namespace App;

use App\Formatters\ShopApiResponseFormatter;
use App\Formatters\ShopWebhookResponseFormatter;
use Glorand\Model\Settings\Traits\HasSettingsTable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Osiset\BasicShopifyAPI\ResponseAccess;
use Osiset\ShopifyApp\Contracts\ShopModel as IShopModel;
use Osiset\ShopifyApp\Traits\ShopModel;

class User extends Authenticatable implements IShopModel
{
    use Notifiable,
        ShopModel,
        HasApiTokens,
        HasSettingsTable;

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
    ];

    /**
     * Update from api response
     *
     * @param $query
     * @param \Osiset\BasicShopifyAPI\ResponseAccess $response
     *
     * @return bool
     */
    public function scopeUpdateFromGraphApiResponse($query, ResponseAccess $response)
    {
        $response = app(ShopApiResponseFormatter::class)->format($response);

        return $query->update($response);
    }

    /**
     * Update from api response
     *
     * @param $query
     * @param $data \stdClass
     *
     * @return bool
     */
    public function scopeUpdateFromWebhook($query, \stdClass $data)
    {
        $response = app(ShopWebhookResponseFormatter::class)->format($data);

        return $query->update($response);
    }
}
