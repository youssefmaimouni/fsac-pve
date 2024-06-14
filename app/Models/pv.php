<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pv extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pv';

    protected $fillable =[
        'id_tablette',
        'file_path'
    ];
    public function pvs()
    {
        return $this->hasMany(PV::class, 'id_tablette');
    }
}
