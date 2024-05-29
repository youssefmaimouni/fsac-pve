<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SurveillantRequest;
use App\Models\surveillant;
use Exception;
use Illuminate\Http\Request;

class surveillantController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/surveillant",
     *     tags={"surveillant"},
     *     summary="Get all admins for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="indSurv",
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
        $surveillants = surveillant::all();
        return response()->json($surveillants);
    }
        /**
     * @OA\Post(
     *     path="/api/surveillant/create",
     *     tags={"surveillant"},
     *     summary="create all admins for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="storesurv",
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
     *     @OA\RequestBody(
     *         description="Book data that needs to be added to the store",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id_departement", type="integer", example=""),
     *             @OA\Property(property="nomComplet_s", type="string", example="")
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
    public function store(SurveillantRequest $request){

        try{
        $surveillant = new surveillant();
        $surveillant->id_surveillant=$request->cid_surveillant;
        $surveillant->id_departement=$request->id_departement;
        $surveillant->nomComplet_s=$request->nomComplet_s;
        $surveillant->save();
        activity()->log("surveillant ajoute");

        return response()->json([
            'status_code'=>201,
            'status_message'=>"le surveillant a été ajouté",
            'data'=>$surveillant
        ]);
        
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }
     /**
     * @OA\Put(
     *     path="/api/surveillant/edit/{surveillant}",
     *     tags={"surveillant"},
     *     summary="update all admins for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="updatesurv",
     *    @OA\Parameter(
     *          name="surveillant",
     *          description="surveillant id",
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
     *             @OA\Property(property="id_departement", type="integer", example=""),
     *             @OA\Property(property="nomComplet_s", type="string", example="")
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

    public function update(SurveillantRequest $request,surveillant $surveillant) {

        try{
        
            $surveillant->id_surveillant=$request->cid_surveillant;
            $surveillant->id_departement=$request->id_departement;
            $surveillant->nomComplet_s=$request->nomComplet_s;
      
        $surveillant->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'le surveillant  a été modifié',
            'data'=>$surveillant
        ]);

        }catch(Exception $exception){
            return response()->json($exception);
        }
       
    }
    /**
     * @OA\Delete(
     *     path="/api/surveillant/{surveillant}",
     *     tags={"surveillant"},
     *     summary="delete all admins for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="deletesurv",
     *     @OA\Parameter(
     *          name="surveillant",
     *          description="surveillant id",
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
    public function delete(surveillant $surveillant) {
         try{
                $surveillant->delete();
                activity()->log("surveillant supprime");
            return response()->json([
                'status_code'=>200,
                'status_message'=>"le surveillant a été supprimer",
                'data'=>$surveillant
            ]);
            
            
         }catch(Exception $exception){
            return response()->json($exception);
        }
    }
}
