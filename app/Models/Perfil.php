<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $table = 'perfiles';

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'perfil_user', 'perfil_id', 'user_id');
    }

    public function agendas()
    {
        return $this->hasMany(Agenda::class, 'perfil_id');
    }
}
