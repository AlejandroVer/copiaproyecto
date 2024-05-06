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
        'empresa_id'
    ];
    protected $table = 'sedes_empresas';

    public function Empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
