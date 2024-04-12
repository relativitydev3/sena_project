<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ventas extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
    // detalle_pedidos

   
}
