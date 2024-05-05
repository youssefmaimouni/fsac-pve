<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller ;
use App\Http\Requests\controlerRequest ;
use App\Models\Controler ;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControlerController extends Controller
{
    public function index(){
        return 'Liste des tablettes ';
    }
    public function store(controlerRequest $request){

        try { 
            $controler= new controler();
            $controler->id_administrateur=$request->id_administrateur;
            $controler->id_tablette=$request->id_tablette;
            $controler->save();
    
        
            return response()->json([
                'status_code'=>201,
                'status_message'=>'Controler a été ajouté',
                'data'=>$controler
            ]);
        
         }catch(Exception $exeption){
            return response()->json($exeption);
        }
        
    } 

    public function update(ControlerRequest $request,$id_administrateur ,$id_tablette ) {
        

        try{
        
            $controler=DB::table('controlers')->where('id_administrateur',$id_administrateur)
                ->where('id_tablette',$id_tablette)
                ->update(['id_administrateur'=>$request->id_administrateur,'id_tablette'=>$request->id_tablette]);

        return response()->json([
            'status_code'=>201,
            'status_message'=>'Controler a été modifié',
            'data'=>$controler
        ]);

        }catch(Exception $exeption){
            return response()->json($exeption);
        }
       
    }
    public function delete(  $id_administrateur,$id_tablette) {
        try{
            $controler = DB::table('controlers')->where('id_administrateur',$id_administrateur)->where('id_tablette',$id_tablette)->delete();

           return response()->json([
               'status_code'=>200,
               'status_message'=>'la gestion  a été supprimer',
               'data'=>$controler
           ]);
           
           
        }catch(Exception $exception){
           return response()->json($exception);
       }
   }
} 