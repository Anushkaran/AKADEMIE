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
        Partner::factory(16)->create()->each(function ($p){
            Student::factory(random_int(100,500))->create([
                'partner_id' => $p->id
            ]);
        });
    }
}
