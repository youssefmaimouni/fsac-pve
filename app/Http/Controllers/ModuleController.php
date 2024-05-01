<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateModuleRequest;
use App\Http\Requests\EditModuleRequest;
use App\Models\module;
use Exception;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index(){
        return 'Liste des modules';
    }
    public function store(CreateModuleRequest $request){

        try{
        $module = new module();
        $module->intitule_module=$request->intitule_module;  
        $module->id_filiere=$request->id_filiere;

        $module->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'le post a été ajouté',
            'data'=>$module
        ]);
        
        }catch(Exception $exeption){
            return response()->json($exeption);
        }
        
    }

    public function update(EditModuleRequest $request,module $module) {
        

        try{
        
        $module->intitule_module=$request->intitule_module;
        $module->id_filiere=$request->id_filiere;
      
        $module->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'la module  a été modifié',
            'data'=>$module
        ]);

        }catch(Exception $exeption){
            return response()->json($exeption);
        }
       
    }

    public function delete(module $module) {
         try{
                $module->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'la module  a été supprimer',
                'data'=>$module
            ]);
            
            
         }catch(Exception $exeption){
            return response()->json($exeption);
        }
    }
}
