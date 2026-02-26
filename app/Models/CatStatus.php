<?php

namespace App\Models;

use App\Models\Marca;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CatStatus extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tbl_cat_estatus';

    protected $primaryKey = 'id_estatus';

    protected $hidden = [
        // 'password'
    ];

    protected $fillable = [
        'nombre',
        'descripcion',
        'color',
        'activo',
        'colorhex'
    ];

    public $timestamps = false;

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_cat_estatus', 'id_estatus');
    }
}
