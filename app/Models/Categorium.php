<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Categorium
 *
 * @property $id
 * @property $imagen
 * @property $nombre
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 *
 * @property Producto[] $productos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Categorium extends Model
{

  static $rules = [
    'imagen' => 'image|mimes:jpg,png|max:2048',
    'nombre' => 'required|unique:categoria,nombre',
    'descripcion' => 'required',
    'activo' => '',
  ];
  static $rulesUpdate = [
    'imagen' => 'image|mimes:jpg,png|max:2048',
    'nombre' => '',
    'descripcion' => '',
    'activo' => '',
  ];
  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['imagen', 'nombre', 'descripcion', 'activo'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function productos()
  {
    return $this->hasMany('App\Models\Producto', 'categorias_id', 'id');
  }
}
