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
        return 'Liste des tablettes controlees';
    }
    public function store(controllerRequest $request){

        try{
        $controller= new controller();
        $controller->id_administrateur=$request->id_administrateur;
        $controller->id_tablette=$request->id_tablette;
        
        

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

    public function update(controllerRequest $request,controller $controller) {
        

        try{
        
            $controller->id_administrateur=$request->id_administrateur;
            $controller->id_tablette=$request->id_tablette;
        
      
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
}  use AuthorizesRequests, ValidatesRequests;
}
