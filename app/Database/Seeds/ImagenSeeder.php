<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ImagenSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        // Obtener los IDs de productos existentes en la tabla "productos"
        $productos = $this->db->table('producto')->select('codigo')->get()->getResultArray();

        foreach ($productos as $producto) {
            // Generar entre 1 y 4 imágenes para cada producto
            $cantidad_imagenes = $faker->numberBetween(1, 4);

            for ($i = 0; $i < $cantidad_imagenes; $i++) {
                // Generar un nombre y un path aleatorios para cada imagen
                $nombre = $faker->sentence(3);
                $path = 'https://picsum.photos/640/480';

                // Insertar la imagen en la tabla "imagenes"
                $data = [
                    'path' => $path,
                    'nombre' => $nombre,
                    'producto' => $producto['codigo']
                ];

                $this->db->table('imagen')->insert($data);
            }
        }
    }
}
