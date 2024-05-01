<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AffectationRequest;
use App\Models\affectation;
use Exception;
use Illuminate\Http\Request;

class affectationController extends Controller
{
    public function index(){
        return 'Liste des affectations';
    }
    public function store(AffectationRequest $request){

        try{
        $affectation = new affectation();
        $affectation->id_tablette=$request->id_tablette;
        $affectation->id_local=$request->id_local;
        $affectation->date_affectation=$request->date_affectation;
        $affectation->demi_journee_affectation=$request->demi_journee_affectation;
        $affectation->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'l\'affectation a été ajouté',
            'data'=>$affectation
        ]);
        
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }

    public function update(AffectationRequest $request,affectation $affectation) {

        try{
        
            $affectation->id_tablette=$request->id_tablette;
            $affectation->id_local=$request->id_local;
            $affectation->date_affectation=$request->date_affectation;
            $affectation->demi_journee_affectation=$request->demi_journee_affectation;
            $affectation->save();

            
        return response()->json([
            'status_code'=>201,
            'status_message'=>'l\'affectation  a été modifié',
            'data'=>$affectation
        ]);

        }catch(Exception $exeption){
            return response()->json($exeption);
        }
       
    }

    public function delete(affectation $affectation) {
         try{
                $affectation->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'l\'affectation  a été supprimer',
                'data'=>$affectation
            ]);
            
            
         }catch(Exception $exeption){
            return response()->json($exeption);
        }
    }
}
