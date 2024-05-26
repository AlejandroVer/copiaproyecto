<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Agenda extends Model
{
    use HasFactory;
    protected $fillable = [

    ];

    protected $table = 'agendas';

    public function setAsignadaElAttribute($value)
    {
        // Puedes ajustar esto según tus necesidades
        $this->attributes['asignada_el'] = Carbon::now();
    }

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'perfil_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visita()
    {
        return $this->hasMany(Visita::class, 'agenda_id');
    }

    public function sedeEmpresa()
    {
        return $this->belongsTo(SedeEmpresa::class, 'sede_empresa_id'); // 'sede_empresa_id' es la clave foránea en la tabla agendas
    }
}
