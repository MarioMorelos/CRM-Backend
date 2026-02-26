<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;
use App\Models\Modulo;

class Rol extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tbl_rol';

    protected $primaryKey = 'id_rol';

    protected $hidden = [
        // 'password'
    ];

    protected $fillable = [
        'rol'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class, 'id_rol', 'id_rol');
    }
    public function modulo()
    {
        return $this->belongsToMany(Modulo::class, 'tbl_rel_rol_modulo', 'id_rol', 'id_modulo');
    }
}
