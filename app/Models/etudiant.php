<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class etudiant extends Model
{
    use HasFactory;
    protected $primaryKey = 'codeApogee';

    protected $fillable =[
        'id_rapport',
        'nom_etudiant',
        'prenom_etudiant',
        'CNE',
        'photo'
    ];
    public function filiere()
    {
        return $this->belongsTo(rapport::class, 'id_rapport');
    }
}
