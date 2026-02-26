<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use app\Models\Modulo;
use app\Models\User;

class Pantalla extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tbl_pantalla';

    protected $primaryKey = 'idpantalla';

    protected $hidden = [
        // 'password'
    ];

    protected $fillable = [
        'nombre',
        'ruta',
        'activo',
        'idmodulo'
    ];

    public $timestamps = false;

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'id_modulo', 'idmodulo');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'tbl_rel_usuario_pantalla', 'id_pantalla', 'idusuario');
    }
}
