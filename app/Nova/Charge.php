<?php

namespace App\Nova;

use App\Nova\Metrics\PartitionMetrics;
use App\Nova\Metrics\TrendMetrics;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Osiset\ShopifyApp\Objects\Enums\ChargeStatus;

class Charge extends Resource
{
    use ResourceCommon;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Charge::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = ['name', '-', 'charge_id'];

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $subtitle = ['type', ' - ', 'interval', 'status'];

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'charge_id',
        'name',
        'type',
        'interval',
        'status',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Shop')
                     ->searchable(),

            BelongsTo::make('Plan'),

            Text::make('Name')
                ->onlyOnDetail(),

            Textarea::make('Terms')
                    ->hideFromIndex(),

            Textarea::make('Description')
                    ->hideFromIndex(),

            Number::make('Charge ID')
                  ->onlyOnDetail(),

            Currency::make('Price')
                  ->sortable(),

            Currency::make('Capped Amount')
                  ->nullable()
                  ->hideFromIndex(),

            Number::make('Trial', 'trial_days')
                    ->displayUsing(function ($value) {
                        return $value ? $value.' days' : '-';
                    }),

            Text::make('Interval'),

            Text::make('Status'),

            Boolean::make('Live', 'test')
                ->displayUsing(function ($value) {
                    return ! $value;
                }),

            DateTime::make('Billing On')
                    ->format('MMM, DD YYYY')
                    ->displayUsing(function ($value) {
                        return $value ? Carbon::parse($value) : null;
                    }),

            DateTime::make('Activated On')
                    ->format('MMM, DD YYYY')
                    ->displayUsing(function ($value) {
                        return $value ? Carbon::parse($value) : null;
                    }),

            DateTime::make('Trial Ends On')
                    ->format('MMM, DD YYYY')
                    ->displayUsing(function ($value) {
                        return $value ? Carbon::parse($value) : null;
                    })
                    ->onlyOnDetail(),

            DateTime::make('Cancelled On')
                    ->format('MMM, DD YYYY')
                    ->displayUsing(function ($value) {
                        return $value ? Carbon::parse($value) : null;
                    })
                    ->onlyOnDetail(),

            DateTime::make('Expires On')
                    ->format('MMM, DD YYYY')
                    ->displayUsing(function ($value) {
                        return $value ? Carbon::parse($value) : null;
                    })
                    ->onlyOnDetail(),

            DateTime::make('Created At')
                    ->format('MMM, DD YYYY')
                    ->hideFromIndex(),

            DateTime::make('Updated At')
                    ->format('MMM, DD YYYY hh:mm A')
                    ->hideFromIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            (new TrendMetrics())->model($this->model()->where('test', false))->column('activated_on')->setName('Activated Per Day'),
            (new PartitionMetrics())->model($this->model()->where('test', false)->where('status', ChargeStatus::ACTIVE()->toNative()))->column('name')->setName('Charges by Plan'),
        ];
    }

    /**
     * Get the filters available for the resource.
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
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [

        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
