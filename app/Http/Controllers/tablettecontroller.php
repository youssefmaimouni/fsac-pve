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
    public function store(){

        // ask le prof;
        
    }

    public function update(tabletteRequest $request,tablette $tablette) {
        
      // ask le prof;
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

