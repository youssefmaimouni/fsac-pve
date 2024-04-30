<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    protected $primaryKey = 'id_rapport';

    protected $fillable =[
        'titre_rapport',
        'contenu',
        'id_pv',
        'codeApogee',
    ];

    public function PV()
    {
        return $this->belongsTo(pv::class, 'id_pv');
    }
    public function etudiant()
    {
        return $this->belongsTo(etudiant::class, 'codeApogee');
    }
}
