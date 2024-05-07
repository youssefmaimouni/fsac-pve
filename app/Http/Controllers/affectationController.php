<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AffectationRequest;
use App\Models\affectation;
use Exception;
use Illuminate\Http\Request;

class affectationController extends Controller
{
     /**
     * @OA\Get(
     *     path="/api/affectation",
     *     tags={"affectation"},
     *     summary="Get affectation for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="indaffectaion",
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
        $affectations = affectation::all();
        return response()->json($affectations);
    }
    /**
     * @OA\Post(
     *     path="/api/affectation/create",
     *     tags={"affectation"},
     *     summary="create all affectaions for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="storeaffectaion",
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
     *             @OA\Property(property="id_tablette", type="integer", example=""),
     *             @OA\Property(property="id_local", type="integer", example=""),
     *             @OA\Property(property="date_affectation", type="date", example=""),
     *             @OA\Property(property="demi_journee_affectation", type="string", example="")
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
    public function store(AffectationRequest $request){

        try{
        $affectation = new affectation();
        $affectation->id_tablette=$request->id_tablette;
        $affectation->id_local=$request->id_local;
        $affectation->date_affectation=$request->date_affectation;
        $affectation->demi_journee_affectation=$request->demi_journee_affectation;
        $affectation->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'l\'affectation a été ajouté',
            'data'=>$affectation
        ]);
        
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }
    /**
     * @OA\Put(
     *     path="/api/affectation/edit/{affectation}",
     *     tags={"affectation"},
     *     summary="update all affectaions for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="updateaffectation",
     *    @OA\Parameter(
     *          name="affectation",
     *          description="affectation id",
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
     *             @OA\Property(property="id_tablette", type="integer", example=""),
     *             @OA\Property(property="id_local", type="integer", example=""),
     *             @OA\Property(property="date_affectation", type="date", example=""),
     *             @OA\Property(property="demi_journee_affectation", type="string", example="")
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

    public function update(AffectationRequest $request,affectation $affectation) {

        try{
        
            $affectation->id_tablette=$request->id_tablette;
            $affectation->id_local=$request->id_local;
            $affectation->date_affectation=$request->date_affectation;
            $affectation->demi_journee_affectation=$request->demi_journee_affectation;
            $affectation->save();

            
        return response()->json([
            'status_code'=>201,
            'status_message'=>'l\'affectation  a été modifié',
            'data'=>$affectation
        ]);

        }catch(Exception $exeption){
            return response()->json($exeption);
        }
       
    }
/**
     * @OA\Delete(
     *     path="/api/affectaion/{affectaion}",
     *     tags={"affectation"},
     *     summary="delete all affectaions for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="deleteaffectation",
     *     @OA\Parameter(
     *          name="affectaion",
     *          description="affectaion id",
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
    public function delete(affectation $affectation) {
         try{
                $affectation->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'l\'affectation  a été supprimer',
                'data'=>$affectation
            ]);
            
            
         }catch(Exception $exeption){
            return response()->json($exeption);
        }
    }
}
