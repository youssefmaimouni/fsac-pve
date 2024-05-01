<?php

namespace App\Http\Controllers;

use App\Models\session;
use Illuminate\Http\Request;

class sessionController extends Controller
{
    public function index(){
        return 'Liste des sessions';
    }
    public function store(CreateSessionRequest $request){

        try{
        $session = new session();
        $session->nom_session=$request->nom_session;
       
        $session->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'session ajouté avec succes',
            'data'=>$session
        ]);
        
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }

    public function update(EditSessionRequest $request,session $session) {
        
        

        try{
        
        $session->id_session=$request->id_session;
        $session->nom_session=$request->nom_session;
        $session->type_session=$request->type_session;
        $session->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>' la session a été modifié',
            'data'=>$session
        ]);

        }catch(Exception $exeption){
            return response()->json($exeption);
        }
       
    }

    public function delete(filiere $filiere) {
         try{
                $session->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'la session  a été supprimer',
                'data'=>$session
            ]);
            
            
         }catch(Exception $exeption){
            return response()->json($exeption);
        }
    }
}
