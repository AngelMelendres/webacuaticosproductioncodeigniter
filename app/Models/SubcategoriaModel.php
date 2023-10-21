<?php

namespace App\Models;

use CodeIgniter\Model;

class SubcategoriaModel extends Model
{
    protected $table            = 'subcategoria';
    protected $primaryKey       = 'codigo';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'codigo',
        'nombre',
    ];

    public function getAllSubcategories()
    {
        return $this->findAll();
    }
    public function countAllSubcategories()
    {
        return $this->countAll();
    }

    /*     public function getCategorias_subcategorias()
    {
        $query = $this->db->table('subcategoria_categoria')
            ->select('categoria.nombre AS categoria, categoria.codigo AS categoria_codigo, subcategoria.nombre AS subcategoria,subcategoria.codigo AS subcategoria_codigo')
            ->join('categoria', 'subcategoria_categoria.categoria_codigo = categoria.codigo')
            ->join('subcategoria', 'subcategoria_categoria.subcategoria_codigo = subcategoria.codigo')
            ->get();

        $results = $query->getResultArray();
        return $results;
    } */

    public function getCategorias_subcategorias()
    {
        $query = $this->db->table('categoria')
            ->select('categoria.nombre AS categoria, categoria.codigo AS categoria_codigo, subcategoria.nombre AS subcategoria, subcategoria.codigo AS subcategoria_codigo')
            ->join('subcategoria_categoria', 'subcategoria_categoria.categoria_codigo = categoria.codigo', 'left')
            ->join('subcategoria', 'subcategoria_categoria.subcategoria_codigo = subcategoria.codigo', 'left')
            ->get();

        $results = $query->getResultArray();
        return $results;
    }
}
