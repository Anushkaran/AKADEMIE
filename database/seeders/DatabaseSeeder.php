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
    public function run()
    {

        User::create([
            'first_name' => 'Jhon',
            'last_name' => 'Do',
            'phone' => '213 0555644966',
            'email' => 'user@app.com',
            'password' => bcrypt('password'),
        ]);
        \App\Models\User::factory(3)->create();

        $this->call(AdminSeeder::class);
    }
}
