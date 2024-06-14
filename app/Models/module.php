<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class module extends Model
{
    use HasFactory;
    protected $primaryKey = 'code_module';

    protected $fillable =[
        'intitule_module',
        'id_filiere'
    ];

    public function filiere()
    {
        return $this->belongsTo(filiere::class, 'id_filiere');
    }
}
