<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pv extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pv';

    protected $fillable =[
        'id_tablette'
    ];
    // public function tablette(){
    //     return $this->belongsTo(tablette::class,'id_tablette');
    // }
}
