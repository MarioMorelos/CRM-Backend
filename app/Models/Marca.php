<?php

namespace App\Models;

use App\Models\Categoria;
use App\Models\CatStatus;
use App\Models\Descarga;
use App\Models\MarcaProyecto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class Marca extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tbl_marcas';

    protected $primaryKey = 'id_marcas';

    protected $hidden = [
        // 'password'
    ];

    protected $fillable = [
        'nombre',
        'logo',
        'id_usuario_marca',
        'id_cat_estatus',
        'activo',
        'fecha_registro',
        'com_rechazo',
        'rs',
        'rfc',
        'tel',
        'contacto',
        'mail_contacto',
        'url',
        'vigencia',
        'promo',
        'restric',
        'cupon',
        'llam_cal',
        'vis_cal',
        'dias_pvencer',
        'id_proy2',
        'promo2',
        'contrato',
        'id_proceso_calidad',
        'imagen'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class, 'idusuario', 'id_usuario_marca');
    }
    public function id_estatus()
    {
        return $this->hasOne(CatStatus::class, 'id_estatus', 'id_cat_estatus');
    }
    public function categoria()
    {
        return $this->belongsToMany(Categoria::class, 'tbl_rel_marca_categoria', 'id_marca', 'id_categoria');
    }
    public function marcaProyecto()
    {
        return $this->hasMany(MarcaProyecto::class, 'id_marca', 'id_marcas');
    }
    public function sucursal()
    {
        return $this->hasMany(Sucursal::class, 'id_marca', 'id_marcas');
    }
    public function descarga()
    {
        return $this->hasMany(Descarga::class, 'id_marca', 'id_marcas');
    }
}
