<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $table = 'tbl_zonas';

    protected $primaryKey = 'id_zona';

    protected $hidden = [
        // 'password'
    ];

    protected $fillable = [
        'zona',
    ];

    public $timestamps = false;

}

