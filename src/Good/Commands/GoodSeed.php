<?php

namespace Denmasyarikin\Inventory\Good\Commands;

use Illuminate\Console\Command;
use Denmasyarikin\Inventory\Good\Seeder\GoodSeeder;

class GoodSeed extends Command
{
    /**
     * name.
     *
     * @var string
     */
    protected $name = 'good:seed';

    /**
     * description.
     *
     * @var string
     */
    protected $description = 'Seed master data';

    /**
     * handle.
     */
    public function handle()
    {
        $seeder = new GoodSeeder($this, __DIR__.'/../database/data/master');

        $seeder->seed();
    }
}
