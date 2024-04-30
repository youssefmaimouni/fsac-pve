<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class examen extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_examen';
    protected $fillable =[
        'id_session',
        'code_module',
        'id_pv',
        'date_examen',
        'demi_journee_examen',
        'seance_examen'
    ];
    public function session()
    {
        return $this->belongsTo(session::class, 'id_session');
    }
    public function module()
    {
        return $this->belongsTo(module::class, 'id_module');
    }
    public function pv()
    {
        return $this->belongsTo(pv::class, 'id_pv');
    }
}
