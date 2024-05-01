<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tabletteController extends Controller
{
    public function index(){
        return 'Liste des tablettes';
    }
    public function store(){

        // ask le prof;
        
    }

    public function update(EditTabletteRequest $request, $tablette) {
        
      // ask le prof;
    }

    public function delete(filiere $filiere) {
         try{
                $tablette->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'tablette est supprimer avec succes',
                'data'=>$tablette
            ]);
            
            
         }catch(Exception $exeption){
            return response()->json($exeption);
        }
    }
}  
}
