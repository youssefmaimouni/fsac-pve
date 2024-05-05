<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\signerRaquest;
use App\Models\signer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class signerController extends Controller
{
    public function index(){
        return 'Liste des signature';
    }
    public function store(signerRaquest $request){

        try{
        $signer = new signer();
        $signer->id_surveillant=$request->id_surveillant;
        $signer->id_pv=$request->id_pv;
        $signer->signature= $request->signature;
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

    public function update(signerRaquest $request,$id_surveillant,$id_pv) {
        
        // $pv=$pv::find($id);

        try{
            $signer=DB::table('signers')->where('id_surveillant',$id_surveillant)
            ->where('id_pv',$id_pv)
            ->update(['id_surveillant'=>$request->id_surveillant,'id_pv'=>$request->id_pv]);

        return response()->json([
            'status_code'=>201,
            'status_message'=>'la signature  a été modifié',
            'data'=>$signer
        ]);

        }catch(Exception $exeption){
            return response()->json($exeption);
        }
       
    }

    public function delete(signer $signer,$id_surveillant,$id_pv) {
         try{
            $signer=DB::table('signers')->where('id_surveillant',$id_surveillant)
            ->where('id_pv',$id_pv)->delete();

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
