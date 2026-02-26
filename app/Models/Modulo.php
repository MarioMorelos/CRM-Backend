<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use app\Models\Pantalla;
use app\Models\Rol;

class Modulo extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tbl_modulo';

    protected $primaryKey = 'id_modulo';

    protected $hidden = [
        // 'password'
    ];

    protected $fillable = [
        'nombre',
        'icono',
        'pagina',
        'orden',
        'activo'
    ];

    public $timestamps = false;

    public function pantalla()
    {
        return $this->hasOne(Pantalla::class, 'idmodulo', 'id_modulo');
    }
    public function rol()
    {
        return $this->belongsToMany(Rol::class, 'tbl_rel_rol_modulo', 'id_modulo', 'id_rol');
    }
}
