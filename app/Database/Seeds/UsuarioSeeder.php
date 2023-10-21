<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $sucursales = $this->db->table('sucursal')->get()->getResult();

        $usuarios = [];

        foreach ($sucursales as $sucursal) {
            for ($i = 1; $i <= 30; $i++) {
                $cedula = $faker->numerify('##########');
                $nombre = $faker->name;
                $email = $faker->email;
                $password = password_hash('password', PASSWORD_DEFAULT);
                $telefono = $faker->numerify('##########');
                $direccion = $faker->address;

                $usuarios[] = [
                    'cedula' => $cedula,
                    'nombre' => $nombre,
                    'email' => $email,
                    'password' => $password,
                    'telefono' => $telefono,
                    'direccion' => $direccion,
                    'sucursal' => $sucursal->cod_sucursal,
                ];
            }
        }

        $this->db->table('usuario')->insertBatch($usuarios);
    }
}
