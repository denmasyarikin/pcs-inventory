<?php

namespace Denmasyarikin\Inventory\Good\database\seeds;

use Illuminate\Database\Seeder;
use Modules\Workspace\Workspace;
use Denmasyarikin\Inventory\Good\Good;
use Denmasyarikin\Inventory\Good\GoodCategory;

class GoodWorkspace extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        foreach (Workspace::get() as $workspace) {
            foreach (GoodCategory::get() as $category) {
                $category->workspaces()->attach($workspace);
            }

            foreach (Good::get() as $good) {
                $good->workspaces()->attach($workspace);
            }
        }
    }
}
