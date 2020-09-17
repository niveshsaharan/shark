<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class Tester extends Resource
{
    use ResourceCommon;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Tester::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'shopify_domain';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $subtitle = 'created_at';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'shopify_domain',
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
            ID::make()
              ->sortable(),

            Text::make('Shopify Domain')
                ->withMeta([
                    'extraAttributes' => [
                        'placeholder' => 'Example: myshop.myshopify.com',
                    ],
                ])
                ->rules(['required', 'unique:\App\Models\Tester,shopify_domain,'.$this->id, function ($attribute, $value, $fail) {
                    if (! Str::endsWith($value, '.myshopify.com')) {
                        return $fail('The value must be a shopify domain.');
                    }
                }])
                ->help('Shopify domain is the permanent domain name that ends with `.myshopify.com`'),

            DateTime::make('Valid till', 'expires_at')
                ->rules([
                    'nullable',
                ])
                ->format('MMM, DD YYYY'),

            DateTime::make('Created At')
                    ->format('MMM, DD YYYY')
                    ->hideWhenUpdating()
                    ->hideWhenCreating(),

            DateTime::make('Updated At')
                    ->format('MMM, DD YYYY')
                    ->hideFromIndex()
                    ->hideWhenCreating()
                    ->hideWhenUpdating(),
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
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
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
