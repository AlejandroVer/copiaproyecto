<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SedenmvCliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_sede',
        'direccion',
        'barrio',
        'ciudad',
        'telefono',
        'nmv_cliente_id'
    ];
    protected $table = 'sedes_nmvclientes';

    public function nmvCliente()
    {
        return $this->belongsTo(NmvCliente::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
