<?php

namespace App\Nova\Metrics\Value;

use App\Models\User;
use App\Nova\Metrics\WithCache;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;
use Osiset\ShopifyApp\Objects\Enums\ChargeStatus;

class PaidShop extends Value
{
    use WithCache;

    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/2';

    /**
     * Set resource name
     *
     * @param $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->result(
            User::join('charges', 'charges.user_id', '=', 'users.id')
                ->where('charges.status', '=', ChargeStatus::ACTIVE()->toNative())
                ->where('charges.test', false)
                ->where('users.shopify_partner', false)
                ->whereNull('charges.cancelled_on')
                ->whereNotNull('users.plan_id')
                ->whereNotIn('users.shopify_plan_display_name', ['affiliate', 'cancelled', 'frozen', 'fraudulent'])
                ->orderBy('users.created_at', 'DESC')
                ->distinct('users.id')
                ->count()
        )->allowZeroResult();
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [];
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'paid-shop-value-metrics';
    }
}
