<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pedido extends Model
{
    use HasFactory;

    public function users()
{
    return $this->belongsTo(User::class, 'id_users');
}

public function detalle_pedidos() {
    return $this->hasMany(detalle_pedidos::class, 'id_pedidos');
}
public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalle_pedidos', 'id_pedidos', 'id_productos')
            ->withPivot('cantidad', 'precio_unitario', 'Nombre');
    }

    public function productosPersonalizados()
    {
        return $this->hasMany(producPerz::class, 'id_pedidos');
    }

}
