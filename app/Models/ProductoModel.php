<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{

    protected $table            = 'producto';
    protected $primaryKey       = 'codigo';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'codigo',
        'nombre',
        'cantidad',
        'precio',
        'costo',
        'descripcion',
        'fecha_publicacion',
        'especificaciones',
    ];



    public function getAllProducts()
    {
        $builder = $this->db->table('producto');
        $builder->select('producto.*, imagen.path AS portada_path');
        $builder->join('imagen', 'imagen.id = producto.portada', 'left'); // Utilizar LEFT JOIN en lugar de JOIN
        $query = $builder->get();

        $results = $query->getResultArray();
        //print_r($results); // Imprimir los resultados

        return $results;
    }


    public function getProductosPorCategoria($categoria_codigo)
    {
        $builder = $this->db->table('producto');
        $builder->select('producto.*, imagen.path AS portada_path');
        $builder->join('producto_categoria', 'producto.codigo = producto_categoria.producto_codigo');
        $builder->join('subcategoria_categoria', 'producto_categoria.subcategoria_codigo = subcategoria_categoria.subcategoria_codigo');
        $builder->join('imagen', 'imagen.id = producto.portada', 'left'); // Utilizar LEFT JOIN en lugar de JOIN
        $builder->where('subcategoria_categoria.categoria_codigo', $categoria_codigo);
        $query = $builder->get();

        $results = $query->getResultArray();
        return $results;
    }


    public function getProductosRecomendados($cantidad)
    {
        $builder = $this->db->table('producto');
        $builder->select('producto.*, imagen.path AS portada_path');
        $builder->join('imagen', 'imagen.id = producto.portada', 'left'); // Utilizar LEFT JOIN en lugar de JOIN
        $builder->orderBy('RAND()'); // Ordenar de forma aleatoria
        $builder->limit($cantidad); // Limitar la cantidad de resultados
        $query = $builder->get();

        $results = $query->getResultArray();
        return $results;
    }

    public function countAllProducts()
    {
        return $this->count();
    }

    public function getProductByCode(string $codigo)
    {
        $producto = $this->db->table('producto')
            ->select("*")
            ->where('producto.codigo', $codigo)
            ->get()
            ->getRowArray();

        return $producto;
    }

    public function getImagenesByProductByCode(string $codigo)
    {
        $imagenes = $this->db->table('imagen')
            ->select('id, path, alt, producto as img_producto_cod')
            ->join('producto', 'imagen.producto = producto.codigo', 'left') // Utilizar LEFT JOIN en lugar de INNER JOIN
            ->where("imagen.producto", $codigo)
            ->get()
            ->getResultArray();
        return  $imagenes;
    }


    public function getCategoriesByProducto($codigo)
    {
        $query = $this->db->table('categoria')
            ->select('categoria.codigo')
            ->join('subcategoria_categoria', 'subcategoria_categoria.categoria_codigo = categoria.codigo')
            ->join('producto_categoria', 'producto_categoria.subcategoria_codigo = subcategoria_categoria.subcategoria_codigo')
            ->where('producto_categoria.producto_codigo', $codigo)
            ->get()
            ->getRowArray();
        return $query;
    }

    public function getSubCategoriesByProducto($codigo)
    {
        $query = $this->db->table('subcategoria')
            ->select('subcategoria.codigo, subcategoria.nombre')
            ->join('producto_categoria', 'producto_categoria.subcategoria_codigo = subcategoria.codigo')
            ->where('producto_categoria.producto_codigo', $codigo)
            ->get()
            ->getResultArray();

        return $query;
    }

    public function deleteProducto($productoCodigo)
    {
        try {
            $this->db->table('imagen')->where('producto', $productoCodigo)->delete();
            $this->db->table('producto')->where('codigo', $productoCodigo)->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateParcial($producto, $productoCodigo)
    {
        try {
            $data = [
                'codigo' => $producto['codigo'],
                'nombre' => $producto['nombre'],
                'cantidad' => $producto['cantidad'],
                'precio' => $producto['precio'],
                'costo' => $producto['costo'],
                'descripcion' => $producto['descripcion']
            ];

            $this->db->table('producto')->where('codigo', $productoCodigo)->update($data);
            return true;
        } catch (\Exception $e) {
            //print_r($producto);
            print_r($e->getMessage());
            return false;
        }
    }

    public function updateCompleto($producto, $productoCodigo)
    {
        try {
            $data = [
                'codigo' => $producto['codigo'],
                'nombre' => $producto['nombre'],
                'cantidad' => $producto['cantidad'],
                'precio' => $producto['precio'],
                'costo' => $producto['costo'],
                'descripcion' => $producto['descripcion'],
                'especificaciones' => $producto['especificaciones'],
                'portada' => $producto['portada'],
            ];

            $this->db->table('producto')->where('codigo', $productoCodigo)->update($data);

            // Actualizar las subcategorías del producto
            $subcategorias = $producto['categorias']; // Obtener las subcategorías desde el arreglo del producto

            // Eliminar todas las relaciones de subcategorías existentes para este producto
            $this->db->table('producto_categoria')->where('producto_codigo', $productoCodigo)->delete();

            // Insertar las nuevas relaciones de subcategorías
            if (!empty($subcategorias)) {
                $subcategoriasData = [];
                foreach ($subcategorias as $subcategoria) {
                    $subcategoriasData[] = [
                        'producto_codigo' => $productoCodigo,
                        'subcategoria_codigo' => $subcategoria
                    ];
                }
                $this->db->table('producto_categoria')->insertBatch($subcategoriasData);
            }
            return true;
        } catch (\Exception $e) {
            // Manejar el error de alguna manera (por ejemplo, mostrar un mensaje de error)
            //echo $e->getMessage();
            return false;
        }
    }

    public function postProducto($producto)
    {
        helper('upload');
        try {
            $data = [
                'codigo' => $producto['codigo'],
                'nombre' => $producto['nombre'],
                'cantidad' => $producto['cantidad'],
                'precio' => $producto['precio'],
                'costo' => $producto['costo'],
                'descripcion' => $producto['descripcion'],
                'especificaciones' => $producto['especificaciones']
            ]; 

            $this->db->table('producto')->insert($data);

            // Obtener el código del nuevo producto insertado
            $productoCodigo = $producto['codigo'];

            // Insertar las relaciones de subcategorías del producto
            $subcategorias = $producto['categorias'];


            if (!empty($subcategorias)) {
                $subcategoriasData = [];
                foreach ($subcategorias as $subcategoria) {
                    $subcategoriasData[] = [
                        'producto_codigo' => $productoCodigo,
                        'subcategoria_codigo' => $subcategoria
                    ];
                }
                $this->db->table('producto_categoria')->insertBatch($subcategoriasData);
            }

            // Verificar y guardar las imágenes
            $rutaDestino = FCPATH . 'public/images/inventario/';
            $portadaId = null; // ID de la primera imagen

            foreach ($producto['imagenes'] as $index => $imagen) {

                if ($imagen->isValid() && !$imagen->hasMoved()) {
                    // Generar un nombre único para la imagen
                    $nombreImagen = $imagen->getRandomName();
                    // Mover la imagen a la carpeta de destino
                    $imagen->move($rutaDestino, $nombreImagen);

                    // Guardar la información de la imagen en la base de datos
                    $data = [
                        'path' => base_url('public/images/inventario/') . $nombreImagen,
                        'alt' => '',
                        'producto' => $productoCodigo
                    ];

                    $imagenModel = new ImagenModel();
                    $imagenModel->insert($data);

                    // Verificar si es la primera imagen y guardar el ID
                    if ($index === 0) {
                        // Guardar el ID de la primera imagen
                        $portadaId = $imagenModel->getInsertID();
                    }
                }
            }



            // Actualizar el campo 'portada' en la tabla 'producto' con el ID de la primera imagen
            $this->db->table('producto')->where('codigo', $productoCodigo)->update(['portada' => $portadaId]);

            
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
