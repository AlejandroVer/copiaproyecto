<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nit',
        'name',
        'rep_legal',
        'cargo_rep_legal',
        'cel_rep_legal',
        'email_rep_legal',
        'jefe_th',
        'cargo_jefe_th',
        'cel_jefe_th',
        'email_jefe_th',
        'contacto_th',
        'cargo_contacto_th',
        'cel_contacto_th',
        'email_contacto_th',
        'numero_trabajadores',
        'estado_empresa',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function nmvCliente()
    {
        return $this->belongsTo(NmvCliente::class);
    }

    public function SedeEmpresa()
    {
        return $this->hasMany(SedeEmpresa::class);
    }
}
