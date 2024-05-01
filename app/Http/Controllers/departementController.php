<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\CreateDepartementRequest;
use App\Http\Requests\CreateDepartementRequest;
use App\Http\Requests\editDepartementRequest;
use App\Models\departement;
use Exception;
use Illuminate\Http\Request;

class departementController extends Controller
{
    public function index(){
        return 'Liste des departements';
    }
    public function store(CreateDepartementRequest $request){

        try{
        $departement = new departement();
        $departement->id_departement=$request->id_departement;
        $departement->nom_departement=$request->nom_departement;
        $departement->code_departement=$request->code_departement;
        $departement->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'le departement a été ajouté',
            'data'=>$departement
        ]);
        
        }catch(Exception $exeption){
            return response()->json($exeption);
        }
        
    }

    public function update(EditDepartementRequest $request,departement $departement) {
        
        // $filiere=$filiere::find($id);

        try{
        
        $departement->id_departement=$request->id_departement;
        $departement->nom_departement=$request->nom_departement;
        $departement->code_departement=$request->code_departement;
      
        $departement->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'le departement a été modifié',
            'data'=>$departement
        ]);

        }catch(Exception $exeption){
            return response()->json($exeption);
        }
       
    }

    public function delete(departement $departement) {
         try{
                $departement->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'le departement  a été supprimer',
                'data'=>$departement
            ]);
            
            
         }catch(Exception $exeption){
            return response()->json($exeption);
        }
    }
}
