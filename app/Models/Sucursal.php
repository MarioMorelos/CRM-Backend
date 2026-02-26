<?php

namespace App\Models;

use App\Models\Marca;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'tbl_sucursales_marca';

    protected $primaryKey = 'id_sucursal';

    protected $hidden = [
        // 'password'
    ];

    protected $fillable = [
        'nombre',
        'tel',
        'calle',
        'num_ext',
        'num_int',
        'referencia',
        'latitud',
        'longitud',
        'cp',
        'id_cp',
        'activo',
        'fecha_registro',
        'id_marca',
        'id_zona',
        'id_banco',
        'num_afiliacion',
        'id_estatus_calidad',
        'id_pais',
        'id_rel_cipa'
    ];

    public $timestamps = false;

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca', 'id_marcas');
    }
}

