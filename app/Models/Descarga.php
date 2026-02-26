<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Descarga extends Model
{
    protected $table = 'tbl_descarga_cupon';

    protected $primaryKey = 'id_descarga_cupon';

    protected $hidden = [
        // 'password'
    ];

    protected $fillable = [
        'id_cliente',
        'id_marca',
        'fecha_descarga',
    ];

    public $timestamps = false;

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca', 'id_marcas');
    }
}

