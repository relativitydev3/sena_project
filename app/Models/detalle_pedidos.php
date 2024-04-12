<?php

namespace App\Models;

use App\Models\detalle_pedidos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle_pedidos extends Model
{
    use HasFactory;

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function detalle_pedidos()
    {
        return $this->belongsTo(detalle_pedidos::class, 'id_pedidos');
    }

    public function pedido()
{
    return $this->belongsTo(Pedido::class, 'id_pedidos');
}
}
