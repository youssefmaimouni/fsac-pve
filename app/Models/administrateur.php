<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class administrateur extends Model implements JWTSubject
{
    
    protected $hidden=[
        'mot_de_passe',
    
    ];

    protected $primaryKey = 'id_administrateur';

    protected $fillable =[
        'mail' ,
        'nom',
        'prenom',
        'Mot_de_passe'
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

