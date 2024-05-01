<?php

namespace App\Models;

use App\Http\Requests\administrateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gerer1 extends Model
{

        use HasFactory;
        protected $primaryKey = [
           ' id_session',
           
           'id_administrateur'
        ];
        
        public function administrateur()
        {
            return $this->belongsTo(administrateur::class, 'id_administrateur');
        }
        public function session()
        {
            return $this->belongsTo(session::class, 'id_session');
        }
       
}
