<?php

namespace Database\Seeders;

use App\Models\Thematic;
use Illuminate\Database\Seeder;

class ThematicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Thematic::factory(10)->create();
    }
}
