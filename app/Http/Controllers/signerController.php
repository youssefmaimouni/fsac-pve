<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PVRequest;
use App\Http\Requests\signerRequest;
use App\Models\pv;
use App\Models\signer;
use Exception;
use Illuminate\Http\Request;

class signerController extends Controller
{
    public function index(){
        return 'Liste des signature';
    }
    public function store(signerRequest $request){

        try{
        $signer = new signer();
        $signer->id_tablette=$request->id_tablette;
        $signer->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'la signature a été ajouté',
            'data'=>$signer
        ]);
        
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }

    public function update(signerRequest $request,signer $signer) {
        
        // $pv=$pv::find($id);

        try{
        
        $signer->id_tablette=$request->id_tablette;
      
        $signer->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'la signature  a été modifié',
            'data'=>$signer
        ]);

        }catch(Exception $exeption){
            return response()->json($exeption);
        }
       
    }

    public function delete(signer $signer) {
         try{
                $signer->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'la signature a été supprimer',
                'data'=>$signer
            ]);
            
            
         }catch(Exception $exeption){
            return response()->json($exeption);
        }
    }
}
