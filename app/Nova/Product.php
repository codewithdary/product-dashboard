<?php

namespace App\Nova;

use App\Nova\Filters\ProductBrand;
use App\Nova\Metrics\AveragePrice;
use App\Nova\Metrics\NewProducts;
use App\Nova\Metrics\ProductsPerDay;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Product::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * @return string
     */
    public function subtitle()
    {
        return "Brand: {$this->brand->name}";
    }

    /**
     * @var int
     */
    public static $globalSearchResults = 5;

    /**
     * Spacing between rows
     * @var string
     */
    // public static $tableStyle = 'tight';

    /**
     * Adds column borders to table
     * @var bool
     */
    //public static $showColumnBorders = true;

    /**
     * Change the page if a user clicks on a row
     * @var string
     */
    public static $clickAction = 'edit';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'description', 'sku'
    ];

    /**
     * Pagination per page
     * @var int[]
     */
    public static $perPageOptions = [50, 100, 150];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Slug::make('Slug')
                ->from('name')
                ->required()
                ->withMeta(['extraAttributes' => [
                'readonly' => true
            ]])->hideFromIndex(),

            Text::make('Name')
                ->required()
                ->showOnPreview()
                ->placeholder('Product name...')->sortable(),

            Markdown::make('Description')
                ->required()
                ->showOnPreview(),

            Currency::make('Price')
                ->currency('EUR')
                ->required()
                ->showOnPreview()
                ->placeholder('Enter product price...')
                ->textAlign('left')
                ->sortable(),

            Text::make('Sku')
                ->required()
                ->placeholder('Enter product SKU...')
                ->help('Number that retailers use to differentiate products and track inventory levels.')
            ->sortable(),

            Number::make('Quantity')
                ->required()
                ->showOnPreview()
                ->placeholder('Enter Quantity...')
                ->textAlign('left')
                ->sortable(),

            BelongsTo::make('Brand')
                ->sortable()
                ->showOnPreview(),

            Boolean::make('Status', 'is_published')
                ->required()
                ->textAlign('left')
                ->sortable()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            new NewProducts(),
            new AveragePrice(),
            new ProductsPerDay()
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            new ProductBrand()
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
