<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class filiere extends Model
{
    protected $primaryKey = 'id_filiere';
    use HasFactory;
    protected $fillable =[
        'nom_filiere'
    ];
}
