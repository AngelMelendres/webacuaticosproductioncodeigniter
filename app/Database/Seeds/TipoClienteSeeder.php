<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TipoClienteSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'codigo' => 'NAT',
                'nombre' => 'Natural',
            ],
            [
                'codigo' => 'JUR',
                'nombre' => 'Juridico',
            ],
            [
                'codigo' => 'CON',
                'nombre' => 'Consumidor final',
            ],
            [
                'codigo' => 'NIN',
                'nombre' => 'Ninguno',
            ],
        ];
    
        $this->db->table('tipo_cliente')->insertBatch($data);
    }
}
