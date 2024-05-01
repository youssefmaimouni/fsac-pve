<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrateur extends Model
{
    

    protected $primaryKey = 'id_administrateur';

    protected $fillable =[
        'mail' ,
        'nom',
        'prenom',
        'Mot_de_passe'
    ];


   
}

