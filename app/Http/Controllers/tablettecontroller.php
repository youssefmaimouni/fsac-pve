<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\tabletteRequest;
use App\Models\tablette;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;

class tabletteController extends RoutingController
{
    public function index(){
        return 'Liste des tablettes';
    }
    public function store(tabletteRequest $request){

        try{
            $tablette = new tablette();
            $tablette->id_tablette=$request->cid_tablette;
            $tablette->adresse_mac=$request->adresse_mac;
            $tablette->numero_serie=$request->numero_serie;
            $tablette->statut=$request->statut;
            $tablette->code_association=$request->code_association;
            $tablette->save();
    
    
            return response()->json([
                'status_code'=>201,
                'status_message'=>"tablette a été ajouté",
                'data'=>$tablette
            ]);
            
            }catch(Exception $exception){
                return response()->json($exception);
            }
        
    }

    public function update(tabletteRequest $request,tablette $tablette) {
        
        try{
        
            $tablette->statut=$request->statut;
      
        $tablette->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'le surveillant  a été modifié',
            'data'=>$tablette
        ]);

        }catch(Exception $exception){
            return response()->json($exception);
        }
    }

    public function delete(tablette $tablette) {
         try{
                $tablette->delete();

                return response()->json([
                'status_code'=>200,
                'status_message'=>'tablette est supprimer avec succes',
                'data'=>$tablette
            ]);
            
            
         }catch(Exception $exception){
            return response()->json($exception);
        }
    }
}  

