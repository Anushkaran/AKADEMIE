<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Models\Student;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run(): void
    {
        Partner::create([
            'name' => 'KLEORH',
            'phone' => '+33676342323',
            'email' => 'kleorh@lakademie.fr',
            'leader' => 'KLEORH',
            'department' => 'Hautes-Alpes',
            'pedagogical_referent' => 'KLEORH',
            'password' => bcrypt('password'),
        ]);
    }
}
