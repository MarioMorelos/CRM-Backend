<?php

namespace App\Models;

use App\Models\Marca;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'tbl_categorias';

    protected $primaryKey = 'id_categoria';

    protected $hidden = [
        // 'password'
    ];

    protected $fillable = [
        'nombre',
        'activo'
    ];

    public $timestamps = false;

    public function marca()
    {
        return $this->belongsToMany(Marca::class, 'tbl_rel_marca_categoria', 'id_categoria', 'id_marcas');
    }
}

