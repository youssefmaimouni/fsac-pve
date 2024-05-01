<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\passerRequest;
use App\Models\passer;
use Exception;
use Illuminate\Http\Request;

class passerController extends Controller
{
    public function index(){
        return 'Liste des examens passes';
    }
    public function store(passerRequest $request){

        try{
        $passer = new passer();
        $passer->id_examen=$request->id_examen;
        $passer->codeApogee=$request->codeApogee;
        $passer->id_local=$request->id_local;
        $passer->num_exam=$request->num_exam;
        

        $passer->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'passer a été ajouté',
            'data'=>$passer
        ]);
        
        }catch(Exception $exeption){
            return response()->json($exeption);
        }
        
    }

    public function update(passerRequest $request,passer $passer) {
        

        try{
        
        $passer->id_examen=$request->id_examen;
        $passer->codeApogee=$request->codeApogee;
        $passer->id_local=$request->id_local;
        $passer->num_exam=$request->num_exam;
      
        $passer->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'passer  a été modifié',
            'data'=>$passer
        ]);

        }catch(Exception $exeption){
            return response()->json($exeption);
        }
       
    }
}
