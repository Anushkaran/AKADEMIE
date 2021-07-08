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
        Skill::factory(100)->create()->each(function ($s){
           Task::factory(random_int(5,10))->create([
               'skill_id' => $s->id
           ]);
        });
    }
}
