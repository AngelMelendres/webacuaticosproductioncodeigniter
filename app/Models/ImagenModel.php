<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagenModel extends Model
{
    protected $table = 'imagen';
    protected $primaryKey = 'id';
    protected $allowedFields = ['path', 'alt', 'producto'];

    public function getIdByFileName($nombreArchivo)
    {
        $this->select('id');
        $this->where('path', $nombreArchivo);
        $query = $this->get();

        $imagen = $query->getRow();

        if ($imagen) {
            return $imagen->id;
        } else {
            // La imagen no fue encontrada en la tabla de imágenes
            // Manejar el caso según tus necesidades
            return null;
        }
    }
}
