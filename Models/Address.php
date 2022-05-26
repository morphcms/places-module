<?php

namespace Modules\Places\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use Modules\Places\Utils\Table;

class Address extends Model
{
    use Searchable;

    protected $guarded = [];

    protected $casts = [
        'meta' => 'object',
        'shipping_default' => 'boolean',
        'billing_default' => 'boolean',
    ];

    public function getTable(): string
    {
        return Table::addresses();
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(State::class, 'city_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function title(): Attribute
    {
        return new Attribute(
            get: fn() => $this->line_one,
        );
    }

    public function description(): Attribute
    {
        $addressFormat = [
            $this->relationLoaded('city') ? $this->city->name : null,
            $this->relationLoaded('country') ? $this->country->name : null,
            $this->postcode,
        ];

        return new Attribute(
            get: fn() => collect($addressFormat)->join(', '),
        );
    }
}
