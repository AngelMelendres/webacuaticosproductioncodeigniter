<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DetalleVentaSeeder extends Seeder
{
    public function run()
    {
        // Obtener facturas y productos
        $facturas = $this->db->table('factura')->get()->getResult();
        // Crear registros en la tabla detalle_venta
        // Crear registros en la tabla detalle_venta
        foreach ($facturas as $factura) {
            $num_productos = rand(1, 5); // Generar cantidad aleatoria de productos por factura
            $productos = $this->db->table('producto')->limit($num_productos)->get()->getResult();

            foreach ($productos as $producto) {
                // Obtener el precio del producto
                $precio_producto = $this->db->table('producto')->select('precio')->where('codigo', $producto->codigo)->get()->getRow()->precio;

                // Calcular subtotal e impuesto
                $cantidad = rand(1, 10);
                $descuento = rand(0, $cantidad * $precio_producto); // Descuento como cantidad de dinero
                $subtotal = $cantidad * $precio_producto - $descuento;
                $impuesto_tasa = 0.13; // Tasa de impuesto del 13%
                $impuesto = $subtotal * $impuesto_tasa;

                $data = [
                    'num_factura' => $factura->num_factura,
                    'codigo_producto' => $producto->codigo,
                    'cantidad' => $cantidad,
                    'precio' => $precio_producto,
                    'descuento' => $descuento,
                    'subtotal' => $subtotal,
                    'impuesto' => $impuesto,
                ];

                $this->db->table('detalle_venta')->insert($data);
            }
        }
    }
}
