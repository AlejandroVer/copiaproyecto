<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nmvCliente extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function empresas()
    {
        return $this->hasMany(Empresa::class);
    }

    public function sedes()
    {
        return $this->hasMany(SedenmvCliente::class);
    }
}
