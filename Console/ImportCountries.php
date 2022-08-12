<?php

namespace Modules\Places\Console;

use function collect;
use DB;
use Http;
use Illuminate\Console\Command;
use Laravel\Scout\EngineManager;
use Modules\Places\Models\Country;

class ImportCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'places:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import countries data.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(EngineManager $manager)
    {
        $this->info('Importing Countries and States');
        $existing = Country::pluck('iso3');

        /**
         * Here we are using Http over Https due to some environments not having
         * the latest CA Authorities installed, causing an SSL exception to be thrown.
         */
        $countries = Http::get('http://cdn.getcandy.io/data/countries+states.json')
            ->object();

        $newCountries = collect($countries)
            ->filter(fn ($country) => ! $existing->contains($country->iso3));

        if (! $newCountries->count()) {
            $this->info('There are no new countries to import');

            return static::SUCCESS;
        }

        DB::transaction(function () use ($newCountries) {
            $this->withProgressBar($newCountries, function ($country) {
                $model = Country::create([
                    'name' => $country->name,
                    'iso3' => $country->iso3,
                    'iso2' => $country->iso2,
                    'phonecode' => $country->phone_code,
                    'capital' => $country->capital,
                    'currency' => $country->currency,
                    'native' => $country->native,
                    'emoji' => $country->emoji,
                    'emoji_u' => $country->emojiU,
                ]);

                $states = collect($country->states)->map(function ($state) {
                    return [
                        'name' => $state->name,
                        'code' => $state->state_code,
                    ];
                });

                $model->states()->createMany($states->toArray());
            });
        });

        $this->line('');

        return static::SUCCESS;
    }
}
