<?php

namespace App\Models;

use App\Models\Marca;
use App\Models\Proyecto;
use Illuminate\Database\Eloquent\Model;

class MarcaProyecto extends Model
{
    protected $table = 'tbl_asig_proyecto';

    protected $primaryKey = 'id_asig_proyecto';

    protected $hidden = [
        // 'password'
    ];

    protected $fillable = [
        'id_marca',
        'id_campania',
        'id_proyecto',
        'f_inicio',
        'vigencia',
        'promo',
        'desc_promo',
        'restric',
        'fecha_registro'
    ];

    public $timestamps = false;

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca', 'id_marcas');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'id_proyecto', 'id_proyecto');
    }
}

