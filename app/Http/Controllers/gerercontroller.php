<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class gerercontroller extends Controller
{
    
        public function index(){
            return 'Liste des sessions gerees';
        }
        public function store(gererRequest $request){
    
            try{
            $gerer1 = new gerer();
            $gerer1->id_administrateur=$request->id_administrateur;
            $gerer1->id_session=$request->id_session;
            
    
    
            $gerer1->save();
    
    
            return response()->json([
                'status_code'=>201,
                'status_message'=>'la gestion est ajoutee',
                'data'=>$gerer1
            ]);
    
            }catch(Exception $exeption){
                return response()->json($exeption);
            }
    
        }
    
        public function update(gererRequest $request,gerer $gerer) {
    
    
            try{
    
            $gerer->id_administrateur=$request->id_administrateur;
           
            $gerer->id_sessions=$request->id_sessions;
            
    
            $gerer->save();
    
            return response()->json([
                'status_code'=>201,
                'status_message'=>'gerer est modifie',
                'data'=>$gerer1
            ]);
    
            }catch(Exception $exeption){
                return response()->json($exeption);
            }
    
        }
}
