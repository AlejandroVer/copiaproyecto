<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'identificacion',
        'telefono',
        'apellidos',
        'email',
        'password',
        'username',
        'nmv_cliente_id',
        'sede_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    //Relacion muchos a mucho

    public function nmvCliente()
    {
        return $this->belongsTo(NmvCliente::class);
    }

    public function sede()
    {
        return $this->belongsTo(SedeNmvcliente::class);
    }

    public function areas(){
        return $this->belongsToMany('App\Models\Area');
    }

    public function empresas(){
        return $this->hasMany(Empresa::class);
    }

    public function SedeEmpresa(){
        return $this->hasMany(SedeEmpresa::class);
    }
    
    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }

    public function perfiles()
    {
        return $this->belongsToMany(Perfil::class, 'perfil_user', 'user_id', 'perfil_id');
    }
}
