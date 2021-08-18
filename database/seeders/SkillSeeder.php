<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\Task;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        Skill::factory(10)->create()->each(function ($s){
           Task::factory(random_int(2,5))->create([
               'skill_id' => $s->id,
               'level_id' => random_int(1,10),
           ]);
        });
    }
}
