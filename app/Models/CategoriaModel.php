<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table            = 'categoria';
    protected $primaryKey       = 'codigo';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'codigo',
        'nombre',
    ];

    public function getAllCategories()
    {
        return $this->findAll();
    }

    public function getAllSubcategories()
    {
        $db = db_connect();

        $query = $db->table('subcategoria')
            ->select('codigo, nombre')
            ->get();

        $result = $query->getResultArray();
        return $result;
    }

    public function getAllCategorias()
    {
        $db = db_connect();

        $query = $db->table('categoria')
            ->select('codigo, nombre')
            ->get();

        $result = $query->getResultArray();
        return $result;
    }


    public function getAllCategoriasConSubcategoria()
    {
        $db = db_connect();

        $query = $db->table('categoria')
            ->select('categoria.codigo, categoria.nombre')
            ->join('subcategoria_categoria', 'categoria.codigo = subcategoria_categoria.categoria_codigo', 'left')
            ->join('subcategoria', 'subcategoria.codigo = subcategoria_categoria.subcategoria_codigo', 'left')
            ->groupBy('categoria.codigo, categoria.nombre')
            ->get();

        $result = $query->getResultArray();

        // Obtener las subcategorías para cada categoría
        foreach ($result as &$row) {
            $subcategoriasQuery = $db->table('subcategoria_categoria')
                ->select('subcategoria.codigo')
                ->join('subcategoria', 'subcategoria_codigo = subcategoria.codigo', 'left')
                ->where('categoria_codigo', $row['codigo'])
                ->get();

            $subcategoriasResult = $subcategoriasQuery->getResultArray();
            $row['subcategorias'] = array_column($subcategoriasResult, 'codigo');
        }

        return $result;
    }

    public function getAllSubcategoriasConCategoria()
    {
        $db = db_connect();

        $query = $db->table('subcategoria')
            ->select('subcategoria.codigo, subcategoria.nombre')
            ->join('subcategoria_categoria', 'subcategoria_codigo = subcategoria.codigo', 'left')
            ->join('categoria', 'categoria_codigo = categoria.codigo', 'left')
            ->groupBy('subcategoria.codigo, subcategoria.nombre')
            ->get();

        $result = $query->getResultArray();

        // Obtener las categorías para cada subcategoría
        foreach ($result as &$row) {
            $categoriasQuery = $db->table('subcategoria_categoria')
                ->select('categoria.codigo')
                ->join('categoria', 'categoria_codigo = categoria.codigo', 'left')
                ->where('subcategoria_codigo', $row['codigo'])
                ->get();

            $categoriasResult = $categoriasQuery->getResultArray();
            $row['categorias'] = array_column($categoriasResult, 'codigo');
        }

        return $result;
    }


    public function postCategoria($categoria)
    {

        try {
            $data = [
                'codigo' => $categoria['codigo'],
                'nombre' => $categoria['nombre'],
            ];

            $this->db->table('categoria')->insert($data);

            // Obtener el código del nuevo producto insertado
            $categoriaCodigo = $categoria['codigo'];

            // Insertar las relaciones de subcategorías del producto
            $subcategorias = $categoria['subcategorias'];


            if (!empty($subcategorias)) {
                $subcategoriasData = [];
                foreach ($subcategorias as $subcategoria) {
                    $subcategoriasData[] = [
                        'subcategoria_codigo' => $subcategoria,
                        'categoria_codigo' => $categoriaCodigo,
                    ];
                }
                $this->db->table('subcategoria_categoria')->insertBatch($subcategoriasData);
            }

            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function postSubCategoria($subcategoria)
    {
        try {
            $data = [
                'codigo' => $subcategoria['codigo'],
                'nombre' => $subcategoria['nombre'],
            ];

            $this->db->table('subcategoria')->insert($data);

            // Obtener el código del nuevo producto insertado
            $subcategoriaCodigo = $subcategoria['codigo'];

            // Insertar las relaciones de subcategorías del producto
            $categorias = $subcategoria['categorias'];

            if (!empty($categorias)) {
                $categoriasData = [];
                foreach ($categorias as $categoria) {
                    // Aquí debes intercambiar los valores de las claves para que se guarden correctamente las relaciones
                    $categoriasData[] = [
                        'subcategoria_codigo' => $subcategoriaCodigo,
                        'categoria_codigo' => $categoria,
                    ];
                }

                //print_r($categoriasData);
                $this->db->table('subcategoria_categoria')->insertBatch($categoriasData);
            }

            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    public function deleteCategoria($categoriaCodigo)
    {
        try {
            $this->db->table('categoria')->where('codigo', $categoriaCodigo)->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function deleteSubCategoria($subCategoriaCodigo)
    {
        try {
            $this->db->table('subcategoria')->where('codigo', $subCategoriaCodigo)->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }




    public function updateCategoria($categoria, $codigo)
    {
        try {
            $data = [
                'codigo' => $categoria['nuevoCodigo'],
                'nombre' => $categoria['nombre'],
            ];

            $this->db->table('categoria')->where('codigo', $codigo)->update($data);


            // Eliminar todas las relaciones de subcategorías existentes para este producto
            $this->db->table('subcategoria_categoria')->where('categoria_codigo', $categoria['nuevoCodigo'])->delete();



            // Insertar las relaciones de subcategorías del producto
            $subcategorias = $categoria['subcategorias'];


            if (!empty($subcategorias)) {
                $subcategoriasData = [];
                foreach ($subcategorias as $subcategoria) {
                    $subcategoriasData[] = [
                        'subcategoria_codigo' => $subcategoria,
                        'categoria_codigo' => $categoria['nuevoCodigo'],
                    ];
                }
                //print_r(json_encode($subcategoriasData));
                $this->db->table('subcategoria_categoria')->insertBatch($subcategoriasData);
            }
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function updateSubCategoria($subcategoria, $codigo)
    {
        try {
            $data = [
                'codigo' => $subcategoria['nuevoCodigo'],
                'nombre' => $subcategoria['nombre'],
            ];

            $this->db->table('subcategoria')->where('codigo', $codigo)->update($data);


            // Eliminar todas las relaciones de subcategorías existentes para este producto
            $this->db->table('subcategoria_categoria')->where('subcategoria_codigo', $subcategoria['nuevoCodigo'])->delete();



            // Insertar las relaciones de subcategorías del producto
            $categorias = $subcategoria['categorias'];


            if (!empty($categorias)) {
                $categoriasData = [];
                foreach ($categorias as $categoria) {
                    $categoriasData[] = [
                        'subcategoria_codigo' => $subcategoria['nuevoCodigo'],
                        'categoria_codigo' => $categoria,
                    ];
                }
                //print_r(json_encode($subcategoriasData));
                $this->db->table('subcategoria_categoria')->insertBatch($categoriasData);
            }
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function countAllCategories()
    {
    }
}
