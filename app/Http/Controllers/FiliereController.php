<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditFiliereRequest;
use App\Http\Requests\CreateFiliereRequest;
use App\Models\filiere;
use Exception;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    public function index(){
        return 'Liste des filiéres';
    }
    public function store(CreateFiliereRequest $request){

        try{
        $filiere = new filiere();
        $filiere->nom_filiere=$request->nom_filiere;
        $filiere->save();


        return response()->json([
            'status_code'=>201,
<<<<<<< HEAD
            'status_message'=>'le post a été ajouté',
=======
            'status_message'=>'la filiére a été ajouté',
            'status_message'=>'la filiere a été ajouté',
>>>>>>> e4e802f22d65e52bb3f3343288e627ef79ea7399
            'data'=>$filiere
        ]);
        
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }

    public function update(EditFiliereRequest $request,filiere $filiere) {
        
        // $filiere=$filiere::find($id);

        try{
        
        $filiere->nom_filiere=$request->nom_filiere;
      
        $filiere->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'la filiere  a été modifié',
            'data'=>$filiere
        ]);

        }catch(Exception $exception){
            return response()->json($exception);
        }
       
    }

    public function delete(filiere $filiere) {
         try{
                $filiere->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'la filiere  a été supprimer',
                'data'=>$filiere
            ]);
            
            
         }catch(Exception $exception){
            return response()->json($exception);
        }
    }
}
