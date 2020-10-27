<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Osiset\ShopifyApp\Contracts\ShopModel;

class ShopLoginEventSubscriber implements ShouldQueue
{
    /**
     * @var int Delay the processing
     */
    public $delay = 30;

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Lab404\Impersonate\Events\TakeImpersonation',
            'App\Listeners\ShopLoginEventSubscriber@handleShopImpersonated',
        );

        $events->listen(
            'shop.login',
            'App\Listeners\ShopLoginEventSubscriber@handleShopLogin',
        );

        $events->listen(
            'shop.installed',
            'App\Listeners\ShopLoginEventSubscriber@handleShopInstalled',
        );
    }

    /**
     * Handle Shop Impersonation
     *
     * @param \Lab404\Impersonate\Events\TakeImpersonation $event
     *
     * @return bool
     */
    public function handleShopImpersonated($event)
    {
        return $this->afterLoggedIn($event->impersonated);
    }

    /**
     * Handle Shop Login
     *
     * @param $shop
     *
     * @return bool
     */
    public function handleShopLogin($shop)
    {
        return $this->afterLoggedIn($shop);
    }

    /**
     * Perform actions after shop login
     * @param $shop
     *
     * @return bool
     */
    private function afterLoggedIn($shop)
    {
        if (! $shop || ! $shop instanceof ShopModel) {
            return false;
        }

        $shopId = $shop->getId();

        $dispatchScriptsAction = resolve(\Osiset\ShopifyApp\Actions\DispatchScripts::class);
        $dispatchWebhooksAction = resolve(\Osiset\ShopifyApp\Actions\DispatchWebhooks::class);
        $afterAuthorizeAction = resolve(\Osiset\ShopifyApp\Actions\AfterAuthorize::class);

        call_user_func($dispatchScriptsAction, $shopId, false);
        call_user_func($dispatchWebhooksAction, $shopId, false);
        call_user_func($afterAuthorizeAction, $shopId, false);

        return true;
    }

    /**
     * Handle Shop Installed
     *
     * @param $shop
     * @param $session array|null
     *
     * @return bool
     */
    public function handleShopInstalled($shop, $session = null)
    {
        if (! $shop->referrer && ($referrer = $session['referrer'] ?? null) && $referrer != $shop->referrer) {
            $shop->referrer = $referrer;
            $shop->save();
        }

        return true;
    }
}
