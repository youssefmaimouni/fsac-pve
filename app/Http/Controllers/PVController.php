<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PVRequest;
use App\Models\pv;
use Exception;
use Illuminate\Http\Request;

class PVController extends Controller
{
     /**
     * @OA\Get(
     *     path="/api/pv",
     *     tags={"Pv"},
     *     summary="Get all Pvs for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="pvindex",
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
     * @OA\Response(
     *         response=401,
     *         description="Authentication information is missing or invalid"
     *     ),
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function index(){
        $pv=pv::all();
        return $pv;
    }
    
     /**
     * @OA\Post(
     *     path="/api/pv/create",
     *     tags={"Pv"},
     *     summary="create all pvs for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="pvstore",
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
     *             @OA\Property(property="id_tablette", type="integer", example="144488"),
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
    public function store(PVRequest $request){

        try{
        $pv = new pv();
        $pv->id_tablette=$request->id_tablette;
        $pv->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'le PV a été ajouté',
            'data'=>$pv
        ]);
        
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }
   /**
     * @OA\Put(
     *     path="/api/pv/edit/{pv}",
     *     tags={"Pv"},
     *     summary="update all pvs for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="pvupdate",
     *    @OA\Parameter(
     *          name="pv",
     *          description="pv id",
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
     *             @OA\Property(property="id_tablette", type="integer", example="144488"),
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
    public function update(PVRequest $request,pv $pv) {
        
        // $pv=$pv::find($id);

        try{
        
        $pv->id_tablette=$request->id_tablette;
      
        $pv->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'le PV  a été modifié',
            'data'=>$pv
        ]);

        }catch(Exception $exeption){
            return response()->json($exeption);
        }
       
    }
/**
     * @OA\Delete(
     *     path="/api/pv/{pv}",
     *     tags={"Pv"},
     *     summary="delete all pvs for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="pvdelete",
     *     @OA\Parameter(
     *          name="pv",
     *          description="pv id",
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
     * @OA\Response(
     *         response=401,
     *         description="Authentication information is missing or invalid"
     *     ),
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function delete(pv $pv) {
         try{
                $pv->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'le PV  a été supprimer',
                'data'=>$pv
            ]);
            
            
         }catch(Exception $exeption){
            return response()->json($exeption);
        }
    }
}
