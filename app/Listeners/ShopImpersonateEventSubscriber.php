<?php

namespace App\Listeners;

use Osiset\ShopifyApp\Contracts\ShopModel;

class ShopImpersonateEventSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Lab404\Impersonate\Events\TakeImpersonation',
            'App\Listeners\ShopImpersonateEventSubscriber@handleShopImpersonated'
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
        /**
         * @var ShopModel
         */
        $shop = $event->impersonated;

        if (! $shop || ! $shop instanceof ShopModel) {
            return false;
        }

        $shopId = $shop->getId();

        $dispatchScriptsAction = resolve(\Osiset\ShopifyApp\Actions\DispatchScripts::class);
        $dispatchWebhooksAction = resolve(\Osiset\ShopifyApp\Actions\DispatchWebhooks::class);
        $afterAuthorizeAction = resolve(\Osiset\ShopifyApp\Actions\AfterAuthorize::class);

        call_user_func($dispatchScriptsAction, $shopId, false);
        call_user_func($dispatchWebhooksAction, $shopId, false);
        call_user_func($afterAuthorizeAction, $shopId);

        return true;
    }
}
