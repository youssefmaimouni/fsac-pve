<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class passer extends Model
{
    use HasFactory;
    protected $primaryKey = [
       ' id_examen',
       'codeApogee',
       'id_local'
    ];
    protected $fillable =[
        'num_exam',
        
    ];
    public function examen()
    {
        return $this->belongsTo(examen::class, 'id_examen');
    }
    public function codeApogee()
    {
        return $this->belongsTo(etudiant::class, 'codeApogee');
    }
    public function local()
    {
        return $this->belongsTo(local::class, 'id_local');
    }
}
