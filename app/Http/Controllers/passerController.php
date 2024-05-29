<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\editpasserRequest;
use App\Http\Requests\passerRequest;
use App\Models\passer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class passerController extends Controller
{
     /**
     * @OA\Get(
     *     path="/api/passer",
     *     tags={"passer"},
     *     summary="Get all passers for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="passerindex",
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
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function index(){
        $passer=passer::all();
        return $passer;
    }
     /**
     * @OA\Post(
     *     path="/api/passer/create",
     *     tags={"passer"},
     *     summary="create all passers for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="passerstore",
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
     *            @OA\Property(property="id_examen", type="integer", example=""),
     *             @OA\Property(property="codeApogee", type="integer", example=""),
     *             @OA\Property(property="id_local", type="integer", example=""),
     *             @OA\Property(property="num_exam", type="integer", example=""),
     *             @OA\Property(property="isPresent", type="boolean", example="")
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
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function store(passerRequest $request){

        try{
        $passer = new passer();
        $passer->id_examen=$request->id_examen;
        $passer->codeApogee=$request->codeApogee;
        $passer->id_local=$request->id_local;
        $passer->num_exam=$request->num_exam;
        $passer->isPresent=$request->isPresent;

        $passer->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'passer a été ajouté',
            'data'=>$passer
        ]);
        
        }catch(Exception $exeption){
            return response()->json($exeption);
        }
        
    }
/**
     * @OA\Put(
     *     path="/api/passer/edit/{id_examen}/{id_local}/{codeApogee}",
     *     tags={"passer"},
     *     summary="update all passers for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="passerupdate",
     *    @OA\Parameter(
     *          name="id_examen",
     *          description="examen id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="id_local",
     *          description="local id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * @OA\Parameter(
     *          name="codeApogee",
     *          description="codeApogee",
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
     *             @OA\Property(property="id_examen", type="integer", example=""),
     *             @OA\Property(property="codeApogee", type="integer", example=""),
     *             @OA\Property(property="id_local", type="integer", example=""),
     *             @OA\Property(property="num_exam", type="integer", example=""),
     *             @OA\Property(property="isPresent", type="boolean", example="")
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
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function update(editpasserRequest $request,$exam,$local,$code) {
        try{

        $passer=DB::table('passers')->where('id_examen',$exam)
        ->where('id_local',$local)->where('codeApogee',$code)
        ->update([ 'num_exam'=>$request->num_exam,
               'id_examen'=>$request->id_examen,
               'id_local'=>$request->id_local,
               'codeApogee'=>$request->codeApogee,
               'isPresent'=>$request->isPresent
    ]);

        return response()->json([
            'status_code'=>201,
            'status_message'=>'passer  a été modifié',
            'data'=>$passer
        ]);

        }catch(Exception $exception){
            return response()->json($exception);
        }
       
    }

/**
     * @OA\Delete(
     *     path="/api/passer/{passer}",
     *     tags={"passer"},
     *     summary="delete all passers for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="passerdelete",
     *     @OA\Parameter(
     *          name="passer",
     *          description="passer id",
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
     *      security={{"bearerAuth":{}}}
     * )
     */
public function delete($exam,$local,$code) {
    try{  
        
        $passer=DB::table('passers')->where('id_examen',$exam)->where('id_local',$local)->where('codeApogee',$code)->delete();

       return response()->json([
           'status_code'=>200,
           'status_message'=>'la passer  a été supprimer',
           'data'=>$passer
       ]);
       
       
    }catch(Exception $exception){
       return response()->json($exception);
   }
}
}
