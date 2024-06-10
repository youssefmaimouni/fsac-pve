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
         /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     tags={"authentification"},
     *     summary="create all signers for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="login",
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status values that needed to be considered for filter",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             default="available",
     *             type="string",
     *             enum={"available", "pending", "sold"},
     *         )
     *     ),
     *      @OA\RequestBody(
     *         description="Book data that needs to be added to the store",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="mail", type="string", example=""),
     *             @OA\Property(property="password", type="string", example=""),
     *             
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent() 
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     ),
     * @OA\Response(
     *         response=401,
     *         description="Authentication information is missing or invalid"
     *     ),
     *      security={{"bearerAuth":{}}}
     * )
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
/**
     * login method
     */
         /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     tags={"authentification"},
     *     summary="create all signers for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="logout",
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status values that needed to be considered for filter",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             default="available",
     *             type="string",
     *             enum={"available", "pending", "sold"},
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent() 
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     ),
     * @OA\Response(
     *         response=401,
     *         description="Authentication information is missing or invalid"
     *     ),
     *      security={{"bearerAuth":{}}}
     * )
     */
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