<?php

namespace App\Nova;

use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Osiset\ShopifyApp\Objects\Enums\PlanInterval;
use Osiset\ShopifyApp\Objects\Enums\PlanType;

class Plan extends Resource
{
    use ResourceCommon, HasDependencies;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Plan::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $subtitle = 'type';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'type',
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

            Text::make('Name')
                ->withMeta([
                    'extraAttributes' => [
                        'placeholder' => 'My plan name',
                    ],
                ])
                ->rules(['required']),

            Select::make('Plan Type', 'type')
                ->options([
                    PlanType::RECURRING()->toNative() => PlanType::RECURRING()->toNative(),
                    PlanType::ONETIME()->toNative() => PlanType::ONETIME()->toNative(),
                ])
                ->displayUsingLabels()
                ->rules(['required'])
                ->sortable(),

            NovaDependencyContainer::make([
                Select::make('Interval')
                    ->options([
                        PlanInterval::EVERY_30_DAYS()->toNative() => PlanInterval::EVERY_30_DAYS()->toNative(),
                        PlanInterval::ANNUAL()->toNative() => PlanInterval::ANNUAL()->toNative(),
                    ])
                    ->displayUsingLabels()
                    ->rules(['required'])
                    ->sortable(),
            ])->dependsOn('type', PlanType::RECURRING()->toNative()),

            Currency::make('Price')
                ->rules(['regex:/^\d+(\.\d{1,2})?$/'])
                ->withMeta([
                    'extraAttributes' => [
                        'placeholder' => '5.00',
                    ],
                ])
                ->sortable(),

            NovaDependencyContainer::make([
                Currency::make('Capped Amount')
                    ->nullable()
                    ->rules(['nullable', 'regex:/^\d+(\.\d{1,2})?$/'])
                    ->withMeta([
                        'extraAttributes' => [
                            'placeholder' => '10.00',
                        ],
                    ])
                    ->help('The maximum amount this plan will charge for usage charges (Fill only for recurring type plans and if you plan to issue usage charges)')
                    ->sortable(),

                Text::make('Terms')
                    ->help('The terms to display for the usage charge/capped_amount (Fill only for recurring type plans and if you plan to issue usage charges)')
                    ->hideFromIndex(),
            ])->dependsOn('type', PlanType::RECURRING()->toNative()),

            Number::make('Trial days', 'trial_days')
                ->rules(['numeric'])
                ->sortable()
                ->withMeta([
                    'extraAttributes' => [
                        'placeholder' => '14',
                    ],
                ])
                ->displayUsing(function ($duration) {
                    return $duration > 0 ? $duration.' days' : '-';
                }),

            Boolean::make('Test')
                  ->sortable(),

            Boolean::make('On Install')
                  ->rules([
                      function ($attribute, $value, $fail) {
                          $alreadyExists = \Osiset\ShopifyApp\Storage\Models\Plan::where('on_install', true)->where('id', '!=', $this->id)->count();

                          if ($alreadyExists > 0 && $value) {
                              \Osiset\ShopifyApp\Storage\Models\Plan::where('id', '!=', $this->id)->update([
                                  'on_install' => false,
                              ]);
                          }

                          if ($alreadyExists === 0 && ! $value) {
                              $fail('One plan is required be set to present on install.');
                          }

                          return true;
                      },
                  ])
                  ->sortable()
                  ->help('Only one plan can have this option checked.'),

            HasMany::make('Shops'),
            HasMany::make('Charges'),
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
