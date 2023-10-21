<?php

namespace App\Models;

use CodeIgniter\Model;

class ajustesProductosModel extends Model
{
    protected $table            = 'ajustesProductos';
    protected $returnType       = 'array';
    protected $allowedFields    = [

        'id',
        'productos_visible',
    ];

    public function getEstado()
    {
        return $this->find(1); // Suponemos que el estado está almacenado en el registro con ID 1
    }

    public function guardarEstado($nuevoEstado)
    {
        $data = [
            'productos_visible' => $nuevoEstado,
        ];

        return $this->update(1, $data); // Actualizar el registro con ID 1
    }
}
