<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departement extends Model
{
   
    protected $primaryKey = 'id_departement';

    protected $fillable =[
        'nom_departement',
        'code_departement',
    ];

}
