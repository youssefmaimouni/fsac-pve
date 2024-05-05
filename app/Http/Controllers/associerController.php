<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssocierRequest;
use App\Models\associer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class associerController extends Controller
{
    public function index(){
        return 'Liste des surveillants affectes';
    }
    public function store(AssocierRequest $request){

        try{
        $associer = new associer();
        $associer->id_surveillant=$request->id_surveillant;
        $associer->id_affectation=$request->id_affectation;
        

        $associer->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'associer a été ajouté',
            'data'=>$associer
        ]);
        
        }catch(Exception $exeption){
            return response()->json($exeption);
        }
        
    }

    public function update(AssocierRequest $request,$surveillant,$affectation) {
        

        try{
            $associer=DB::table('associers')->where('id_surveillant',$surveillant)->where('id_affectation',$affectation)
            ->update([
                "id_surveillant"=>$request->id_surveillant,
                "id_affectation"=>$request->id_affectation
            ]);
           
 

        return response()->json([
            'status_code'=>201,
            'status_message'=>'associer  a été modifié',
            'data'=>$associer
        ]);

        }catch(Exception $exception){
            return response()->json($exception);
        }
       
    }
    public function delete($surveillant,$affectation) {
        try{  
            
            $associer=DB::table('associers')->where('id_surveillant',$surveillant)->where('id_affectation',$affectation)->delete();
    
           return response()->json([
               'status_code'=>200,
               'status_message'=>'la associer  a été supprimer',
               'data'=>$associer
           ]);
           
           
        }catch(Exception $exception){
           return response()->json($exception);
       }
    }
}
