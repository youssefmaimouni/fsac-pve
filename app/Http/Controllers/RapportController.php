<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RapportRequest;
use App\Models\Rapport;
use Exception;
use Illuminate\Http\Request;

class RapportController extends Controller
{
     /**
     * @OA\Get(
     *     path="/api/rapport",
     *     tags={"rapport"},
     *     summary="Get all rapports for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="rapportindex",
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
        $rapport=rapport::all();
        return $rapport;
    }
     /**
     * @OA\Post(
     *     path="/api/rapport/create",
     *     tags={"rapport"},
     *     summary="create all rapports for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="rapportstore",
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
     *             @OA\Property(property="titre_rapport", type="string", example=""),
     *             @OA\Property(property="contenu", type="text", example=""),
     *             @OA\Property(property="id_pv", type="integer", example=""),
     *             @OA\Property(property="codeApogee", type="integer", example=""),
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
    public function store(RapportRequest $request){

        try{
        $rapport = new Rapport();
        $rapport->titre_rapport=$request->titre_rapport;
        $rapport->contenu=$request->contenu;
        $rapport->id_pv=$request->id_pv;
        $rapport->codeApogee=$request->codeApogee;
        $rapport->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'la rapport a été ajouté',
            'data'=>$rapport
        ]);
        
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }
/**
     * @OA\Put(
     *     path="/api/rapport/edit/{rapport}",
     *     tags={"rapport"},
     *     summary="update all rapports for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="rapportupdate",
     *    @OA\Parameter(
     *          name="rapport",
     *          description="rapport id",
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
     *             @OA\Property(property="titre_rapport", type="string", example=""),
     *             @OA\Property(property="contenu", type="text", example=""),
     *             @OA\Property(property="id_pv", type="integer", example=""),
     *             @OA\Property(property="codeApogee", type="integer", example=""),
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
    public function update(RapportRequest $request,Rapport $rapport) {
        
        // $filiere=$filiere::find($id);

        try{
        
            $rapport->titre_rapport=$request->titre_rapport;
            $rapport->contenu=$request->contenu;
            $rapport->id_pv=$request->id_pv;
            $rapport->codeApogee=$request->codeApogee;
            $rapport->save();
        return response()->json([
            'status_code'=>201,
            'status_message'=>'le rapport  a été modifié',
            'data'=>$rapport
        ]);

        }catch(Exception $exeption){
            return response()->json($exeption);
        }
       
    }
/**
     * @OA\Delete(
     *     path="/api/rapport/{rapport}",
     *     tags={"rapport"},
     *     summary="delete all rapports for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="rapportdelete",
     *     @OA\Parameter(
     *          name="rapport",
     *          description="rapport id",
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
    public function delete(Rapport $rapport) {
         try{
                $rapport->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'le rapport  a été supprimer',
                'data'=>$rapport
            ]);
            
            
         }catch(Exception $exeption){
            return response()->json($exeption);
        }
    }
}
