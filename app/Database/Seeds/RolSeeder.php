<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['codigo' => 'ADM', 'nombre' => 'administrador'],
            ['codigo' => 'CNT', 'nombre' => 'contador'],
            ['codigo' => 'VEN', 'nombre' => 'vendedor'],
            ['codigo' => 'GER', 'nombre' => 'gerente'],
            ['codigo' => 'MST', 'nombre' => 'master'],
        ];

        $this->db->table('rol')->insertBatch($roles);
    }
}
