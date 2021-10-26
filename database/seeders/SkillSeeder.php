<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\Task;
use Exception;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * @var string[][]
     */
    protected $skills = array(
        array('id' => '1','name' => 'TRAVAILLER DANS LE SAAD','description' => 'Met en œuvre un accompagnement structuré et collaboratif','created_at' => '2021-09-23 08:31:18','updated_at' => '2021-09-23 09:27:44'),
        array('id' => '2','name' => 'CONDITIONS DE BIENTRAITANCE','description' => 'Met en œuvre un accompagnement relationnel adapté','created_at' => '2021-09-23 08:31:28','updated_at' => '2021-09-23 09:28:02'),
        array('id' => '3','name' => 'PRATIQUES SECURITAIRES','description' => 'Met en œuvre un accompagnement sécuritaire et favorable au maintien de l\'autonomie','created_at' => '2021-09-23 08:31:50','updated_at' => '2021-09-23 09:28:36'),
        array('id' => '4','name' => 'TECHNIQUES MENAGERES ET DU LINGE','description' => 'Techniques ménagères et entretien du linge','created_at' => '2021-09-23 08:31:58','updated_at' => '2021-09-23 09:29:04'),
        array('id' => '5','name' => 'TECHNIQUES CULINAIRES','description' => 'Techniques culinaires','created_at' => '2021-09-23 08:32:06','updated_at' => '2021-09-23 09:29:17'),
        array('id' => '6','name' => 'TECHNIQUE HYGIENE ET CONFORT','description' => 'Techniques d\'hygiène et de confort et aider à la mobilité','created_at' => '2021-09-23 08:32:13','updated_at' => '2021-09-23 09:29:46')
    );


    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        Skill::insert($this->skills);
    }
}
