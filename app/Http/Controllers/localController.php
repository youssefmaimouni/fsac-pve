<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocalRequest;
use App\Models\local;
use Exception;
use Illuminate\Http\Request;

class localController extends Controller
{
    public function index(){
        return 'Liste des article';
    }
    public function store(LocalRequest $request){

        try{
        $local = new local();
        $local->num_local=$request->num_local;  
        $local->type_local=$request->type_local;

        $local->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'le local a été ajouté',
            'data'=>$local
        ]);
        
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }

    public function update(localRequest $request,local $local) {
        

        try{
        
        $local->num_local=$request->num_local;
        $local->type_local=$request->type_local;
      
        $local->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'le local  a été modifié',
            'data'=>$local
        ]);

        }catch(Exception $exception){
            return response()->json($exception);
        }
       
    }

    public function delete(local $local) {
         try{
                $local->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'le local  a été supprimer',
                'data'=>$local
            ]);
            
            
         }catch(Exception $exception){
            return response()->json($exception);
        }
    }
}
