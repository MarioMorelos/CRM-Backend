<?php

namespace App\Models;

use App\Models\MarcaProyecto;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'tbl_proyectos';

    protected $primaryKey = 'id_proyecto';

    protected $hidden = [
        // 'password'
    ];

    protected $fillable = [
        'nombre_proyecto',
        'activo',
    ];

    public $timestamps = false;

    public function promo()
    {
        return $this->hasMany(MarcaProyecto::class, 'id_proyecto', 'id_proyecto');
    }
}

