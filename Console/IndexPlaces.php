<?php

namespace Modules\Places\Console;

use Illuminate\Console\Command;
use Laravel\Scout\EngineManager;
use Modules\Places\Models\Address;
use Modules\Places\Models\Country;
use Modules\Places\Models\State;

class IndexPlaces extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'places:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create all necessary indexes for the places module.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(EngineManager $engineManager)
    {
        $engine = $engineManager->engine();

        $searchables = [
            Country::class,
            State::class,
            Address::class,
        ];

        // Make sure we have the relevant indexes ready to go.
        foreach ($searchables as $searchable) {
            $this->call('scout:import', ['model' => $searchable]);
        }

        return static::SUCCESS;
    }
}
