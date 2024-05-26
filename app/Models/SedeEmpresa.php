<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SedeEmpresa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_sede',
        'direccion',
        'barrio',
        'ciudad',
        'geoubicacion',
        'telefono',
        'estado',
        'empresa_id'
    ];
    protected $table = 'sedes_empresas';

    public function Empresa()
    {
        return $this->belongsTo(Empresa::class,'empresa_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function agendas()
    {
        return $this->hasMany(Agenda::class, 'sede_empresa_id'); // 'sede_empresa_id' es la clave foránea en la tabla agendas
    }
    
}
