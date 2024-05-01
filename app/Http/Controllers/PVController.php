<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PVRequest;
use App\Models\pv;
use Exception;
use Illuminate\Http\Request;

class PVController extends Controller
{
    public function index(){
        return 'Liste des PVs';
    }
    public function store(PVRequest $request){

        try{
        $pv = new pv();
        $pv->id_tablette=$request->id_tablette;
        $pv->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'le PV a été ajouté',
            'data'=>$pv
        ]);
        
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }

    public function update(PVRequest $request,pv $pv) {
        
        // $pv=$pv::find($id);

        try{
        
        $pv->id_tablette=$request->id_tablette;
      
        $pv->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'le PV  a été modifié',
            'data'=>$pv
        ]);

        }catch(Exception $exeption){
            return response()->json($exeption);
        }
       
    }

    public function delete(pv $pv) {
         try{
                $pv->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'le PV  a été supprimer',
                'data'=>$pv
            ]);
            
            
         }catch(Exception $exeption){
            return response()->json($exeption);
        }
    }
}
