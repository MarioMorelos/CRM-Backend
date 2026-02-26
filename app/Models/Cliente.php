<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'tbl_clientes';

    protected $primaryKey = 'id_cliente';

    protected $hidden = [
        // 'password'
    ];

    protected $fillable = [
        'nombre_cliente',
        'key_clte',
        'img_logo',
        'img_banner',
        'activo',
        'publico',
    ];

    public $timestamps = false;

}

