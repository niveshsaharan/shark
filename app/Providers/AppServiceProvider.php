<?php

namespace App\Providers;

use App\Formatters\ShopApiResponseFormatter;
use App\Formatters\ShopWebhookResponseFormatter;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        ShopApiResponseFormatter::class => ShopApiResponseFormatter::class,
        ShopWebhookResponseFormatter::class => ShopWebhookResponseFormatter::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }
}
