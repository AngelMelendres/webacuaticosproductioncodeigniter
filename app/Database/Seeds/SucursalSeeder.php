<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class SucursalSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $sucursales = [];

        for ($i = 1; $i <= 5; $i++) {
            $nombre = $faker->company;
            $cod_sucursal = strtoupper(substr($nombre, 0, 3));
            $ciudad = $faker->city;
            $direccion = $faker->address;

            $sucursales[] = [
                'cod_sucursal' => $cod_sucursal,
                'nombre' => $nombre,
                'ciudad' => $ciudad,
                'direccion' => $direccion,
            ];
        }

        $this->db->table('sucursal')->insertBatch($sucursales);
    }
}
