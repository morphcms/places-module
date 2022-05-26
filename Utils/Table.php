<?php

namespace Modules\Places\Utils;

class Table
{

    public static function countries(): string
    {
        return static::prefix('countries');
    }

    public static function states(): string
    {
        return static::prefix('states');
    }

    public static function addresses(): string
    {
        return static::prefix('addresses');
    }

    protected static function prefix(string $table): string
    {
        return config('places.table_prefix', '') . $table;
    }
}
