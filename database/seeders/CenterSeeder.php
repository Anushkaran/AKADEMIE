<?php

namespace Database\Seeders;

use App\Models\Center;
use Illuminate\Database\Seeder;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Center::create([
            'name' => 'KLEORH METZ',
            'phone' => 'KLEORH +33676342323',
            'note' => 'METZ',
            'address' => 'METZ',
        ]);
    }
}
