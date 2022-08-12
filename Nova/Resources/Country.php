<?php

namespace Modules\Places\Nova\Resources;

use App\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Modules\Places\Models\Country as CountryModel;

class Country extends Resource
{
    public static string $model = CountryModel::class;

    public static $title = 'name';

    public static $displayInNavigation = false;

    public static $search = [
        'name', 'iso3', 'iso2', 'capital',
    ];

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')->required(),
            Text::make('ISO3')->required(),
            Text::make('ISO2')->nullable()->hideFromIndex(),
            Text::make('Phone Code', 'phonecode')->required(),
            Text::make('Currency')->required(),
            Text::make('Emoji')->required(),
            Text::make('Emoji U')->required()->hideFromIndex(),
            Text::make('Capital')->nullable(),
            Text::make('Native')->nullable(),
        ];
    }
}
