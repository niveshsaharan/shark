<?php

namespace App\Nova\Metrics\Value;

use App\Models\User;
use App\Nova\Metrics\WithCache;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class InstalledShopCount extends Value
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
            User::whereNotNull('shopify_plan_display_name')
                ->where('shopify_plan_display_name', '!=', '')
                ->orderBy('users.created_at', 'DESC')
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
        return 'installed-shop-count-value-metrics';
    }
}
