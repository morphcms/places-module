<?php

namespace Modules\Places\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Modules\Places\Utils\Table;

class Country extends Model
{
    use Searchable;

    protected $guarded = [];

    public function getTable(): string
    {
        return Table::countries();
    }

    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function toSearchableArray()
    {
        return [
            'capital' => $this->capital,
            'name' => $this->name,
            'native' => $this->native,
            'iso3' => $this->iso3,
        ];
    }
}
