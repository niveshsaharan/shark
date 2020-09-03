<?php

namespace App\Nova;

use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use KABBOUCHI\NovaImpersonate\Impersonate;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Timezone;
use Laravel\Nova\Panel;

class Shop extends Resource
{
    use ResourceCommon, HasDependencies;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\User::class;

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
    public static $subtitle = ['shop_name', ' - ', 'shopify_plan_display_name'];

    /**
     * Order by
     * @var array
     */
    public static $orderBy = [
        'created_at' => 'desc',
    ];

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
        'shop_email',
        'contact_email',
        'domain',
        'shop_name',
        'city',
        'province',
        'country',
        'currency',
        'presentment_currencies',
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Shops');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Shop');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $fields = [
            ID::make()
            ->sortable(),

            Gravatar::make('Avatar', 'shop_email')
                    ->onlyOnIndex(),

            Text::make('Name', 'shop_name')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->sortable(),

            Text::make('Primary email', 'shop_email')
                ->onlyOnDetail()
                ->sortable(),

            Text::make('Contact email')
                ->onlyOnDetail(),

            Text::make('Shopify domain', 'name')
                ->hideWhenUpdating()
                ->sortable()
                ->withMeta([
                    'extraAttributes' => [
                        'placeholder' => 'Example: myshop.myshopify.com',
                    ],
                ])
                ->rules(['required', function ($attribute, $value, $fail) {
                    if (! Str::endsWith($value, '.myshopify.com')) {
                        return $fail('The value must be a shopify domain.');
                    }
                }])
                ->help('Shopify domain is the permanent domain name that ends with `.myshopify.com`'),

            NovaDependencyContainer::make([
                Password::make('Password')
                    ->onlyOnForms()
                    ->hideWhenUpdating()
                    ->creationRules('required', 'string', 'min:6'),
            ])->dependsOn('api_type', 'private'),

            Text::make('Domain', 'domain')
                ->onlyOnDetail()
                ->sortable(),

            Boolean::make('Grandfathered', 'shopify_grandfathered')
                ->hideFromIndex(),

            Boolean::make('Freemium', 'shopify_freemium')
                ->onlyOnDetail(),

            new Panel('Shopify', $this->shopifyFields()),

            new Panel('Address', $this->addressFields()),

            new Panel('Currency', $this->moneyFields()),

            new Panel('Shopify API', $this->shopifyApiFields()),

            BelongsTo::make('Billing Plan', 'plan', Plan::class),

            DateTime::make('Created', 'created_at')
                ->format('MMM, DD YYYY')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->sortable(),

            DateTime::make('Updated At')
                ->format('MMM, DD YYYY hh:mm A')
                ->onlyOnDetail(),

            Impersonate::make($this),
            HasMany::make('Charges'),
        ];

        return $fields;
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
            (new \App\Nova\Metrics\ValueMetrics())->model(\App\User::class)->dateColumn('created_at')->setName('Shops'),
            (new \App\Nova\Metrics\TrendMetrics())->model(\App\User::class)->column('created_at')->setName('Shops Per Day'),
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

    /**
     * Get the address fields for the resource.
     *
     * @return array
     */
    protected function addressFields()
    {
        return [
            Text::make('City')
                ->onlyOnDetail(),

            Text::make('Province code')
                ->onlyOnDetail(),

            Text::make('Province', 'province')
                ->onlyOnDetail(),

            Text::make('Country code')
                ->onlyOnDetail(),

            Text::make('Country')
                ->onlyOnDetail(),
        ];
    }

    /**
     * Get the shopify fields for the resource.
     *
     * @return array
     */
    protected function shopifyFields()
    {
        return [
            Text::make('Shopify plan', 'shopify_plan_display_name')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->sortable(),

            Timezone::make('Timezone', 'iana_timezone')
                ->onlyOnDetail(),

            Boolean::make('Shopify partner')
                ->onlyOnDetail(),

            Boolean::make('Shopify PLUS')
                ->onlyOnDetail(),

            Text::make('API scopes', 'shopify_scopes')
                ->displayUsing(function ($value) {
                    return $value ? implode(', ', $value) : '';
                })
                ->onlyOnDetail(),
        ];
    }

    protected function moneyFields()
    {
        return [
            Text::make('Money format')
                ->onlyOnDetail(),

            Text::make('Money with currency format')
                ->onlyOnDetail(),

            Text::make('Money in email format')
                ->onlyOnDetail(),

            Text::make('Money with currency in email format')
                ->onlyOnDetail(),

            Text::make('Primary currency', 'currency')
                ->onlyOnDetail(),

            Text::make('Presentment currencies')
                ->displayUsing(function ($value) {
                    return $value ? implode(', ', $value) : '';
                })
                ->onlyOnDetail(),
        ];
    }

    protected function shopifyApiFields()
    {
        return [
            Select::make('API type')
                ->options([
                    'public' => 'Public App',
                    'private' => 'Private App',
                    'custom' => 'Custom App',
                ])
                ->displayUsingLabels()
                ->default(function ($request) {
                    return 'public';
                })
                ->hideFromIndex(),

            NovaDependencyContainer::make([
                Text::make('API Key')
                    ->rules('required')
                    ->hideFromIndex(),

                NovaDependencyContainer::make([
                    Text::make('API Password')
                        ->rules('required')
                        ->hideFromIndex(),
                ])->dependsOn('api_type', 'private'),

                Text::make('API Secret')
                    ->rules('required')
                    ->hideFromIndex(),
            ])->dependsOnNot('api_type', 'public'),
        ];
    }
}
