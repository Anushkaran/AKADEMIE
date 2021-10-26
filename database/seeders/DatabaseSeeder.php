<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(ThematicSeeder::class);

        User::create([
            'first_name' => 'Jhon',
            'last_name' => 'Do',
            'organization' => 'testing',
            'type' => 'practical',
            'department' => config('departments')[0]['dep_name'],
            'phone' => '213 0555644966',
            'email' => 'user@app.com',
            'password' => bcrypt('password'),
        ]);

        $this->call(AdminSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(CenterSeeder::class);
        $this->call(PartnerSeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(StudentSeeder::class);
    }
}
