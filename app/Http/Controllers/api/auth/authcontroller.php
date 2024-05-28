<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\loginrequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
public function logout()
{
    try {
        Auth::guard('api')->logout();  // Invalidate the token

        return response()->json(['message' => 'Successfully logged out']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Something went wrong while logging out.'], 500);
    }
}

}