<?php

namespace Modules\Places\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Places\Models\Address;

/**
 * @mixin Model
 * @property-read Collection $addresses
 */
trait HasAddresses
{
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }
}
