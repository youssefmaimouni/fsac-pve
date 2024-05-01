<?php

namespace App\Http\Controllers;
use App\Http\Requests\sessionRequest;
use App\Models\session;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class sessionController extends Controller
{
    public function index(){
        return 'Liste des sessions';
    }
    public function store(sessionRequest $request){
        try{
        $session = new session();
        $session->nom_session=$request->nom_session;
        $session->type_session=$request->type_session;
<<<<<<< HEAD
       
=======
>>>>>>> ca9396872d51a711314a61de43bf9fd1cb77c48c
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

    public function update(sessionRequest $request,session $session) {
        
        

        try{
        
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

    public function delete(session $session) {
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
