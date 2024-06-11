<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablette extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_tablette';
    protected $fillable = ['device_id','statut', 'code_association'];

}