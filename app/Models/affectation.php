<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class affectation extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_affectation';

    protected $fillable =[
        'id_tablette',
        'id_local',
        'date_affectation',
        'demi_journee_affectation',
    ];
    public function local()
    {
        return $this->belongsTo(local::class, 'id_local');
    }

    public function tablette()
    {
        return $this->belongsTo(tablette::class, 'id_tablette');
    }

}
