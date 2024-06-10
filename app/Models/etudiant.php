<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class etudiant extends Model
{
    protected $primaryKey = 'codeApogee';

    protected $fillable =[
        'nom_etudiant',
        'prenom_etudiant',
        'CNE',
        'photo'
    ];
    public function rapport()
    {
        return $this->belongsTo(rapport::class, 'id_rapport');
    }
}
