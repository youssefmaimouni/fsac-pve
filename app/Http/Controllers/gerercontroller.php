<?php

namespace App\Http\Controllers;

use App\Http\Requests\gererRequest;
use App\Models\gerer;
use Exception;
use Illuminate\Support\Facades\DB;

class gererController extends Controller
{
    
        public function index(){
            return 'Liste des sessions gerees';
        }
        public function store(gererRequest $request){
    
            try{
            $gerer = new gerer();
            $ger  er->id_session=$request->id_session;
            $gerer->id_administrateur=$request->id_administrateur;   
            $gerer->save();
    
    
            return response()->json([
                'status_code'=>201,
                'status_message'=>'la gestion est ajoutee',
                'data'=>$gerer
            ]);
    
            }catch(Exception $exeption){
                return response()->json($exeption);
            }
    
        }
    
        public function update(gererRequest $request,  $id_administrateur,$id_session) {
            try {
                
                $gerer=DB::table('gerers')->where('id_administrateur',$id_administrateur)
                ->where('id_session',$id_session)
                ->update(['id_administrateur'=>$request->id_administrateur,'id_session'=>$request->id_session]);
                
                return response()->json([
                    'status_code' => 201,
                    'status_message' => 'La gestion a été modifiée',
                    'data' => $gerer
                ]);
        
            } catch(Exception $exception) {
                return response()->json($exception);
            }
        }
            public function delete(  $id_administrateur,$id_session) {
                try{
                    $gerer = DB::table('gerers')->where('id_administrateur',$id_administrateur)->where('id_session',$id_session)->delete();
       
                   return response()->json([
                       'status_code'=>200,
                       'status_message'=>'la gestion  a été supprimer',
                       'data'=>$gerer
                   ]);
                   
                   
                }catch(Exception $exception){
                   return response()->json($exception);
               }
           }
        
}
