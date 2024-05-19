<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocalRequest;
use App\Models\local;
use Exception;
use Illuminate\Http\Request;

class localController extends Controller
{
     /**
     * @OA\Get(
     *     path="/api/local",
     *     tags={"local"},
     *     summary="Get all locals for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="localindex",
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
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     ),
     * )
     */
    public function index(){
        $local=local::all();
        return $local;
    }
     /**
     * @OA\Post(
     *     path="/api/local/create",
     *     tags={"local"},
     *     summary="create all locals for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="localstore",
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
     *             @OA\Property(property="num_local", type="integer", example=""),
     *             @OA\Property(property="type_local", type="string", example="")
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
     * )
     */
    public function store(LocalRequest $request){

        try{
        $local = new local();
        $local->num_local=$request->num_local;  
        $local->type_local=$request->type_local;

        $local->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'le local a été ajouté',
            'data'=>$local
        ]);
        
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }
/**
     * @OA\Put(
     *     path="/api/local/edit/{local}",
     *     tags={"local"},
     *     summary="update all locals for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="localupdate",
     *    @OA\Parameter(
     *          name="local",
     *          description="local id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *         description="Book data that needs to be added to the store",
     *         required=true,
     *         @OA\JsonContent(
     *            @OA\Property(property="num_local", type="integer", example=""),
     *             @OA\Property(property="type_local", type="string", example="")
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
     * )
     */
    public function update(localRequest $request,local $local) {
        

        try{
        
        $local->num_local=$request->num_local;
        $local->type_local=$request->type_local;
      
        $local->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'le local  a été modifié',
            'data'=>$local
        ]);

        }catch(Exception $exception){
            return response()->json($exception);
        }
       
    }
/**
     * @OA\Delete(
     *     path="/api/local/{local}",
     *     tags={"local"},
     *     summary="delete all locals for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="localdelete",
     *     @OA\Parameter(
     *          name="local",
     *          description="local id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent() 
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     ),
     * )
     */
    public function delete(local $local) {
         try{
                $local->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'le local  a été supprimer',
                'data'=>$local
            ]);
            
            
         }catch(Exception $exception){
            return response()->json($exception);
        }
    }
}
