<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Campaign\Models\Campaign;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campaign::factory()->count(5)->create();
    }
}
