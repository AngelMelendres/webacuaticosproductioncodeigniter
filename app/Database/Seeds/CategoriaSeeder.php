<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['codigo' => 'cat1', 'nombre' => 'Categoría 1'],
            ['codigo' => 'cat2', 'nombre' => 'Categoría 2'],
            ['codigo' => 'cat3', 'nombre' => 'Categoría 3'],
            ['codigo' => 'cat4', 'nombre' => 'Categoría 4'],
            ['codigo' => 'cat5', 'nombre' => 'Categoría 5'],
            ['codigo' => 'cat6', 'nombre' => 'Categoría 6'],
            ['codigo' => 'cat7', 'nombre' => 'Categoría 7'],
            ['codigo' => 'cat8', 'nombre' => 'Categoría 8'],
            ['codigo' => 'cat9', 'nombre' => 'Categoría 9'],
            ['codigo' => 'cat10', 'nombre' => 'Categoría 10'],
        ];
    
        $this->db->table('categoria')->insertBatch($data);
    }
}
