<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;


class administrateur extends Authenticatable  implements JWTSubject
{
    public function isAdmin()
    {
        return $this->role === 'admin';  // Assuming there is a 'role' attribute
    }
    protected $hidden=[
        'password',
    
    ];
    use HasFactory;
    protected $primaryKey = 'id_administrateur';

    protected $fillable =[
        'mail' ,
        'nom',
        'prenom',
        'password'
    ];

// Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
   
}

