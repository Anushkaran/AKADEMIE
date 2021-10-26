<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{

    protected $levels = array(
        array('id' => '1','name' => 'NIVEAU 1','created_at' => '2021-08-22 16:27:26','updated_at' => '2021-09-23 08:33:20'),
        array('id' => '2','name' => 'NIVEAU 2','created_at' => '2021-08-22 16:27:27','updated_at' => '2021-09-23 08:33:30'),
        array('id' => '3','name' => 'NIVEAU 3','created_at' => '2021-08-22 16:27:27','updated_at' => '2021-09-23 08:33:39'),
        array('id' => '4','name' => 'NIVEAU 4','created_at' => '2021-08-22 16:27:27','updated_at' => '2021-09-23 08:33:46'),
        array('id' => '5','name' => 'NIVEAU 5','created_at' => '2021-08-22 16:27:27','updated_at' => '2021-09-23 08:33:54')
    );
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::insert($this->levels);
    }
}
