<?php

namespace Denmasyarikin\Inventory\Commands;

use Illuminate\Console\Command;
use Denmasyarikin\Inventory\Good\Seeder\Seeder;

class GoodSeed extends Command
{
	/**
	 * name
	 *
	 * @var string
	 */
    protected $name = 'good:seed';

    /**
     * description
     *
     * @var string
     */
    protected $description = 'Seed master data';
    
    /**
     * handle
     */
    public function handle()
    {
    	$seeder = new Seeder($this, __dir__ . '/../Good/database/data/master');

    	$seeder->seed();
    }
}