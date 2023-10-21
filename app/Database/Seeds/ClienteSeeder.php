<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ClienteSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $data = [];
        for ($i = 1; $i <= 100; $i++) {
            $cedula = $faker->unique()->numerify('##########');
            $data[] = [
                'codigo' => $cedula,
                'cedula' => $cedula,
                'nombre' => $faker->firstName(),
                'nombre_comercial' => $faker->company(),
                'direccion' => $faker->address(),
                'email' => $faker->email(),
                'telefono' => $faker->numerify('##########'),
                'tipo_cliente' => $faker->randomElement(['NAT', 'JUR','CON',"NIN"]),
            ];
        }

        $this->db->table('cliente')->insertBatch($data);
    }
}
