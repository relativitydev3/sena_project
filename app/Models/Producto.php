<?php

namespace App\Models;

use App\Models\detalle_pedidos;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $id
 * @property $imagen
 * @property $nombre
 * @property $precio
 * @property $descripcion
 * @property $categorias_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Categorium $categorium
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{

  static $rules = [
    'imagen' => 'required|image|mimes:jpg,png|max:2048',
    'nombre' => 'required',
    'precio' => 'required|numeric',
    'descripcion' => 'required',
    'activo' => 'required',
    'categorias_id' => 'required'
  ];
  static $rulesUpdate = [
    'imagen' => 'image|mimes:jpg,png|max:2048',
    'nombre' => '',
    'precio' => 'numeric',
    'descripcion' => '',
    'activo' => '',
    'categorias_id' => 'required',
    'insumos' => 'array' // Validar que los insumos sean un arreglo
  ];
  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['imagen', 'nombre', 'precio', 'descripcion', 'activo', 'categorias_id'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function categorium()
  {
    return $this->hasOne('App\Models\Categorium', 'id', 'categorias_id');
  }

  public function insumos()
  {
    return $this->belongsToMany(Insumo::class, 'insumo_producto', 'producto_id', 'insumo_id');
  }

  public function detallesPedidos()
  {
    return $this->hasMany('App\Models\detalle_pedidos', 'id_productos', 'id');
  }
  public function producto()
  {
    return $this->belongsTo(Productos::class, 'Prductos', 'id');
  }
  public function iinsumos()
  {
      return $this->belongsToMany(Insumo::class);
  }
}
