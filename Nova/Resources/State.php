<?php

namespace Modules\Places\Nova\Resources;

use App\Nova\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Modules\Places\Models\State as StateModel;

class State extends Resource
{
    public static string $model = StateModel::class;

    public static $title = 'name';

    public static $displayInNavigation = false;

    public static $search = [
        'name', 'code',
    ];

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Country', 'country', Country::class),
            Text::make('Name')->required(),
            Text::make('Code')->required(),
        ];
    }

}
