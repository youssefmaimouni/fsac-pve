<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\CreatedepartementRequest;
use App\Http\Requests\CreatedepartementRequest;
use App\Http\Requests\editdepartementRequest;
use App\Models\departement;
use Exception;
use Illuminate\Http\Request;

class departementController extends Controller
{
        /**
     * @OA\Get(
     *     path="/api/departement",
     *     tags={"departement"},
     *     summary="Get all admins for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="indept",
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
        $departement=departement::all();
        return response()->json($departement);
    }
        /**
     * @OA\Post(
     *     path="/api/departement/create",
     *     tags={"departement"},
     *     summary="create all admins for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="storedept",
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
     *             @OA\Property(property="nom_departement", type="string", example=""),
     *             @OA\Property(property="code_departement", type="string", example="")
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
    public function store(CreatedepartementRequest $request){

        try{
        $departement = new departement();
        $departement->id_departement=$request->id_departement;
        $departement->nom_departement=$request->nom_departement;
        $departement->code_departement=$request->code_departement;
        $departement->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'le departement a été ajouté',
            'data'=>$departement
        ]);
        
        }catch(Exception $exeption){
            return response()->json($exeption);
        }
        
    }
     /**
     * @OA\Put(
     *     path="/api/departement/edit/{departement}",
     *     tags={"departement"},
     *     summary="update all admins for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="updatedept",
     *    @OA\Parameter(
     *          name="departement",
     *          description="departement id",
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
     *             @OA\Property(property="nom_departement", type="string", example=""),
     *             @OA\Property(property="code_departement", type="string", example="")
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

    public function update(EditdepartementRequest $request,departement $departement) {
        
        // $filiere=$filiere::find($id);

        try{
        
        
        $departement->nom_departement=$request->nom_departement;
        $departement->code_departement=$request->code_departement;
      
        $departement->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'le departement a été modifié',
            'data'=>$departement
        ]);

        }catch(Exception $exeption){
            return response()->json($exeption);
        }
       
    }
    /**
     * @OA\Delete(
     *     path="/api/departement/{departement}",
     *     tags={"departement"},
     *     summary="delete all admins for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="deletedept",
     *     @OA\Parameter(
     *          name="departement",
     *          description="departement id",
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

    public function delete(departement $departement) {
         try{
                $departement->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'le departement  a été supprimer',
                'data'=>$departement
            ]);
            
            
         }catch(Exception $exeption){
            return response()->json($exeption);
        }
    }
}
