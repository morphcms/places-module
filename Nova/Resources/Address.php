<?php

namespace Modules\Places\Nova\Resources;


use App\Nova\Resource;
use App\Nova\User;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Modules\Places\Models\Address as AddressModel;

class Address extends Resource
{
    public static string $model = AddressModel::class;

    public static $title = 'id';

    public static $displayInNavigation = false;


    public static $search = [
        'line_one', 'city', 'postcode', 'email', 'phone',
    ];


    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('User', 'user', User::class),

            Boolean::make('Shipping Default'),
            Boolean::make('Billing Default'),

            Panel::make('Personal Information', [
                Text::make('First Name')->required(),
                Text::make('Last Name')->required(),
                Text::make('Company Name')->nullable(),
            ]),

            Panel::make('Location', [
                BelongsTo::make('Country', 'country', Country::class),
                Text::make('Line One')->required(),
                Text::make('Line Two')->nullable(),
                Text::make('City')->required(),
                Text::make('State')->nullable(),
                Text::make('Postcode')->nullable(),
                Textarea::make('Delivery Instructions')->nullable()->rows(2),
            ]),

            Panel::make('Contact', [
                Text::make('Phone', 'contact_phone')->nullable(),
            ]),

            Panel::make('Other', [
                KeyValue::make('Meta')->nullable(),
            ])
        ];
    }
}
