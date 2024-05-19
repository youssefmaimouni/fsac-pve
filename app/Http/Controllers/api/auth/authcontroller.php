<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\loginrequest;
use Exception;
use Illuminate\Http\Request;

class authcontroller extends Controller
{
    /**
     * login method
     */
    public function login(loginrequest $request){
      try{
          $token=auth()->attempt($request->validated());
          //dd($token);
          if($token){
            return $this->responseWithToken($token, auth()->user());
          }
          else {
            return response()->json([
                'status'=>'failed',
                'message'=>'Invalid credentials'
            ],401);
          }
        }catch(Exception $exception){
          return response()->json($exception);
      }
    }
    public function responseWithToken($token, $administrateur)
    {
      return response()->json([
        'status' => 'success',
        'user' => $administrateur,
        "access_token" => $token,
        'type' => 'bearer'
      ]);
    }
    public function logout(){
      try{
        auth()->logout();
        return response()->json([
          'message'=>'administrateur est logged out'
        ],201);

      }catch(Exception $exception){
        return response()->json($exception);
    }
    }
}