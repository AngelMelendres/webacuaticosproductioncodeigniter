<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PortadaProductoSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT producto.codigo, imagen.id, imagen.path
                            FROM imagen
                            INNER JOIN producto ON imagen.producto = producto.codigo
                            ORDER BY imagen.producto, imagen.id');

        $data = [];

        $currentProductoId = null;

        foreach ($query->getResult() as $row) {
            $codigo = $row->codigo;
            $id_imagen = $row->id;
            $path_imagen = $row->path;

            
                // Este es un nuevo producto, seleccionamos la primera imagen como portada
                $portada = $id_imagen;
            

            $data[] = [
                'codigo' => $codigo,
                'portada' => $portada,
            ];
        }

        $db->table('producto')->updateBatch($data, 'codigo');
    }
}
