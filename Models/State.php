<?php

namespace Modules\Places\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JetBrains\PhpStorm\ArrayShape;
use Laravel\Scout\Searchable;
use Modules\Places\Utils\Table;

class State extends Model
{
    use Searchable;

    protected $guarded = [];

    public function getTable(): string
    {
        return Table::states();
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    #[ArrayShape(['name' => 'string', 'code' => 'string'])]
    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
        ];
    }
}
