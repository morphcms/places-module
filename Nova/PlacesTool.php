<?php

namespace Modules\Places\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Tool;
use Modules\Places\Nova\Resources\Address;
use Modules\Places\Nova\Resources\Country;
use Modules\Places\Nova\Resources\State;

class PlacesTool extends Tool
{
    protected static array $resources = [
        Country::class,
        State::class,
        Address::class,
    ];

    public function boot()
    {
        \Nova::resources(static::$resources);
    }

    public function menu(Request $request)
    {
        return MenuSection::make('Places', [
            MenuItem::resource(Address::class)->canSee(fn () => true),
            MenuItem::resource(Country::class)->canSee(fn () => true),
            MenuItem::resource(State::class)->canSee(fn () => true),
        ])->icon('location-marker')->collapsable();
    }
}
