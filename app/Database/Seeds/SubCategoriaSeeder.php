<?php

namespace App\Database\Seeds;
use Faker\Factory;

use CodeIgniter\Database\Seeder;

class SubCategoriaSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $data = [
                'codigo' => $faker->unique()->regexify('[A-Z]{3}\d{2}'),
                'nombre' => $faker->unique()->jobTitle()
            ];

            $this->db->table('subcategoria')->insert($data);
        }
    }
}
