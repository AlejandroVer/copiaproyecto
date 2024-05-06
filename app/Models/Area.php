<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    //Relacion muchos a muchos 
        //Relacion muchos a muchos
        public function users(){
            return $this->belongsToMany('App\Models\User');
        }
}
