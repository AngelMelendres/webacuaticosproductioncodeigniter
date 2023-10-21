<?php

namespace App\Database\Seeds;

use Faker\Factory;

use CodeIgniter\Database\Seeder;

class Producto_Categoria_Seeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        // Obtener los códigos de categorías y subcategorías existentes en las tablas
        $productos = $this->db->table('producto')->select('codigo')->get()->getResultArray();
        $subcategorias = $this->db->table('subcategoria')->select('codigo')->get()->getResultArray();

        $contador = 0;

        while ($contador < 50) {
            // Obtener un código de categoría y subcategoría aleatorio de las tablas existentes
            $produco = $faker->randomElement($productos);
            $subcategoria = $faker->randomElement($subcategorias);

            $data = [
                'subcategoria_codigo' => $subcategoria['codigo'],
                'producto_codigo' => $produco['codigo']
            ];

            // Verificar si ya existe un registro con la misma combinación de valores
            $registro_existente = $this->db->table('producto_categoria')->where($data)->get()->getRow();

            if (!$registro_existente) {
                $this->db->table('producto_categoria')->insert($data);
                $contador++;
            }
        }
    }
}
