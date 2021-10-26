<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Student::create([
            'first_name' => 'Aymen',
            'last_name' => 'Bouffaghar',
            'email' => 'aymenbouf@gmail.com',
            'phone' => '0540739550',
            'address' => 'Algerie',
            'partner_id' => 1
        ]);
    }
}
