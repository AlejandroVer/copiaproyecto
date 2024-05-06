<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

    protected $table = 'visitas';

    public function agenda()
    {
        return $this->belongsTo(Agenda::class, 'agenda_id');
    }
}
