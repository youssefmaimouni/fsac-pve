<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamenRequest;
use App\Models\examen;
use Exception;
use Illuminate\Http\Request;

class examenController extends Controller
{
    public function index(){
        return 'Liste des examens';
    }
    public function store(ExamenRequest $request){

        try{
        $examen = new examen();
        $examen->id_session=$request->id_session;
        $examen->code_module=$request->code_module;
        $examen->id_pv=$request->id_pv;
        $examen->date_examen=$request->date_examen;
        $examen->demi_journee_examen=$request->demi_journee_examen;
        $examen->seance_examen=$request->seance_examen;
        $examen->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'l examen a été ajouté',
            'data'=>$examen
        ]);
        
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }

    public function update(examenRequest $request,examen $examen) {
        
        // $examen=$examen::find($id);

        try{
        
            $examen->id_session=$request->id_session;
            $examen->code_module=$request->code_module;
            $examen->id_pv=$request->id_pv;
            $examen->date_examen=$request->date_examen;
            $examen->demi_journee_examen=$request->demi_journee_examen;
            $examen->seance_examen=$request->seance_examen;
      
        $examen->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'la examen  a été modifié',
            'data'=>$examen
        ]);

        }catch(Exception $exception){
            return response()->json($exception);
        }
       
    }

    public function delete(examen $examen) {
         try{
                $examen->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'la examen  a été supprimer',
                'data'=>$examen
            ]);
            
            
         }catch(Exception $exception){
            return response()->json($exception);
        }
    }
}
