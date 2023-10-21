<?php

namespace App\Database\Seeds;

use Faker\Factory;

use CodeIgniter\Database\Seeder;

class SubCategoria_Categoria_Seeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        // Obtener los códigos de categorías y subcategorías existentes en las tablas
        $categorias = $this->db->table('categoria')->select('codigo')->get()->getResultArray();
        $subcategorias = $this->db->table('subcategoria')->select('codigo')->get()->getResultArray();

        $contador = 0;

        while ($contador < 50) {
            // Obtener un código de categoría y subcategoría aleatorio de las tablas existentes
            $categoria = $faker->randomElement($categorias);
            $subcategoria = $faker->randomElement($subcategorias);

            $data = [
                'subcategoria_codigo' => $subcategoria['codigo'],
                'categoria_codigo' => $categoria['codigo']
            ];

            // Verificar si ya existe un registro con la misma combinación de valores
            $registro_existente = $this->db->table('subcategoria_categoria')->where($data)->get()->getRow();

            if (!$registro_existente) {
                $this->db->table('subcategoria_categoria')->insert($data);
                $contador++;
            }
        }
    }
}
