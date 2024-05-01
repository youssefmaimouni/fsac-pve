<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SurveillantRequest;
use App\Models\surveillant;
use Exception;
use Illuminate\Http\Request;

class surveillantController extends Controller
{
    public function index(){
        return 'Liste des surveillants';
    }
    public function store(SurveillantRequest $request){

        try{
        $surveillant = new surveillant();
        $surveillant->id_surveillant=$request->cid_surveillant;
        $surveillant->id_departement=$request->id_departement;
        $surveillant->nomComplet_s=$request->nomComplet_s;
        $surveillant->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>"le surveillant a été ajouté",
            'data'=>$surveillant
        ]);
        
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }

    public function update(SurveillantRequest $request,surveillant $surveillant) {

        try{
        
            $surveillant->id_surveillant=$request->cid_surveillant;
            $surveillant->id_departement=$request->id_departement;
            $surveillant->nomComplet_s=$request->nomComplet_s;
      
        $surveillant->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'le surveillant  a été modifié',
            'data'=>$surveillant
        ]);

        }catch(Exception $exception){
            return response()->json($exception);
        }
       
    }

    public function delete(surveillant $surveillant) {
         try{
                $surveillant->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>"le surveillant a été supprimer",
                'data'=>$surveillant
            ]);
            
            
         }catch(Exception $exception){
            return response()->json($exception);
        }
    }
}
