<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\editpasserRequest;
use App\Http\Requests\passerRequest;
use App\Models\passer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function update(editpasserRequest $request,$exam,$local,$code) {
        try{

        $passer=DB::table('passers')->where('id_examen',$exam)
        ->where('id_local',$local)->where('codeApogee',$code)
        ->update([ 'num_exam'=>$request->num_exam,
               'id_examen'=>$request->id_examen,
               'id_local'=>$request->id_local,
               'codeApogee'=>$request->codeApogee
    ]);

        return response()->json([
            'status_code'=>201,
            'status_message'=>'passer  a été modifié',
            'data'=>$passer
        ]);

        }catch(Exception $exception){
            return response()->json($exception);
        }
       
    }


public function delete($exam,$local,$code) {
    try{  
        
        $passer=DB::table('passers')->where('id_examen',$exam)->where('id_local',$local)->where('codeApogee',$code)->delete();

       return response()->json([
           'status_code'=>200,
           'status_message'=>'la passer  a été supprimer',
           'data'=>$passer
       ]);
       
       
    }catch(Exception $exception){
       return response()->json($exception);
   }
}
}
