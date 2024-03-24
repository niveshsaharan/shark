<?php

namespace App\Nova\Lenses;

use App\Nova\Plan;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Lenses\Lens;
use Osiset\ShopifyApp\Objects\Enums\ChargeStatus;

class PaidShop extends Lens
{
    /**
     * Set resource name
     *
     * @param $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\LensRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering(
            $request->withFilters(
                $query->select(self::columns($request))
                    ->join('charges', 'charges.user_id', '=', 'users.id')
                    ->where('charges.status', '=', ChargeStatus::ACTIVE()->toNative())
                    ->where('charges.test', false)
                    ->where('users.shopify_partner', false)
                    ->whereNull('charges.cancelled_on')
                    ->whereNotNull('users.plan_id')
                    ->whereNotIn('users.shopify_plan_display_name', ['affiliate', 'cancelled', 'frozen', 'fraudulent'])
                    ->orderBy('users.created_at', 'DESC')
                    ->groupBy('users.id')
            )
        );
    }

    /**
     * Get the columns that should be selected.
     *
     * @return array
     */
    protected static function columns($request)
    {
        return [
            'users.id',
            'users.shop_name',
            'users.shop_email',
            'users.shopify_domain',
            'users.shopify_plan_display_name',
            'users.plan_id',
            'users.created_at',
        ];
    }

    /**
     * Get the fields available to the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make('ID')->sortable(),
            Gravatar::make('Avatar', 'shop_email'),
            Text::make('Shop Name')->sortable(),
            Text::make('Shopify Domain'),
            Text::make('Shopify Plan', 'shopify_plan_display_name')->sortable(),
            BelongsTo::make('Billing Plan', 'plan', Plan::class),
            DateTime::make('Created At')->format('MMM, DD YYYY'),
        ];
    }

    /**
     * Get the cards available for the lens.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function cards(Request $request)
    {
        return [
        ];
    }

    /**
     * Get the filters available for the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [

        ];
    }

    /**
     * Get the actions available on the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return parent::actions($request);
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'paid-shop-lense';
    }
}
