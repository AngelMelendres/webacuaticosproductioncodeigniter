<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $data = [];
        for ($i = 1; $i <= 200; $i++) {
            $codigo = $faker->unique()->numerify('PROD-#####');
            $nombre = $faker->words(3, true);
            $cantidad = $faker->numberBetween(1, 100);
            $precio = $faker->randomFloat(2, 1, 100);
            $costo = $faker->randomFloat(2, 0.5, $precio);
            $descripcion = $faker->paragraph();
            $fecha_inicio = '2019-01-01 00:00:00';
            $fecha_fin = '2022-12-31 23:59:59';
            $fecha_publicacion = $faker->dateTimeBetween($fecha_inicio, $fecha_fin)->format('Y-m-d H:i:s');
            $especificaciones = $faker->paragraph();
            $data[] = [
                'codigo' => $codigo,
                'nombre' => $nombre,
                'cantidad' => $cantidad,
                'precio' => $precio,
                'costo' => $costo,
                'descripcion' => $descripcion,
                'fecha_publicacion' => $fecha_publicacion,
                'especificaciones' => $especificaciones,
            ];
        }
        $this->db->table('producto')->insertBatch($data);
    }
}
