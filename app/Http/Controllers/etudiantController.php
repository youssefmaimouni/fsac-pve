<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EtudiantRequest;
use App\Models\etudiant;
use Exception;
use Illuminate\Http\Request;

class etudiantController extends Controller
{
     /**
     * @OA\Get(
     *     path="/api/etudiant",
     *     tags={"etudiant"},
     *     summary="Get all etudiants for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="etudiantindex",
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
        $etudiant=etudiant::all();
        return $etudiant;
    }
     /**
     * @OA\Post(
     *     path="/api/etudiant/create",
     *     tags={"etudiant"},
     *     summary="create all etudiants for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="etudiantstore",
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
     *             @OA\Property(property="nom_etudiant", type="string", example=""),
     *             @OA\Property(property="prenom_etudiant", type="string", example=""),
     *             @OA\Property(property="CNE", type="string", example=""),
     *             @OA\Property(property="photo", type="string", example=""),
     *             @OA\Property(property="codeApogee", type="integer", example="")
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
    public function store(EtudiantRequest $request){

        try{
        $etudiant = new etudiant();
        //$etudiant->codeApogee=$request->codeApogee;
        $etudiant->id_rapport=$request->id_rapport;
        $etudiant->nom_etudiant=$request->nom_etudiant;
        $etudiant->prenom_etudiant=$request->prenom_etudiant;
        $etudiant->CNE=$request->CNE;
        $etudiant->codeApogee=$request->codeApogee;
        $etudiant->photo=$request->photo;
        $etudiant->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>"l'etudiant a été ajouté",
            'data'=>$etudiant
        ]);
        
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }
/**
     * @OA\Put(
     *     path="/api/etudiant/edit/{etudiant}",
     *     tags={"etudiant"},
     *     summary="update all etudiants for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="etudiantupdate",
     *    @OA\Parameter(
     *          name="etudiant",
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
     *              @OA\Property(property="codeApogee", type="integer", example=""),
     *             @OA\Property(property="nom_etudiant", type="string", example=""),
     *             @OA\Property(property="prenom_etudiant", type="string", example=""),
     *             @OA\Property(property="CNE", type="string", example=""),
     *             @OA\Property(property="photo", type="string", example=""),
     *              @OA\Property(property="id_rapport", type="integer", example="")
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
    public function update(EtudiantRequest $request,etudiant $etudiant) {

        try{
        
            $etudiant->id_rapport=$request->id_rapport;
            $etudiant->nom_etudiant=$request->nom_etudiant;
            $etudiant->prenom_etudiant=$request->prenom_etudiant;
            $etudiant->CNE=$request->CNE;
            $etudiant->photo=$request->photo;
            $etudiant->codeApogee=$request->codeApogee;
      
        $etudiant->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'la etudiant  a été modifié',
            'data'=>$etudiant
        ]);

        }catch(Exception $exception){
            return response()->json($exception);
        }
       
    }
/**
     * @OA\Delete(
     *     path="/api/etudiant/{etudiant}",
     *     tags={"etudiant"},
     *     summary="delete all etudiants for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="etudiantdelete",
     *     @OA\Parameter(
     *          name="etudiant",
     *          description="codeApogee",
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
    public function delete(etudiant $etudiant) {
         try{
                $etudiant->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>"l'etudiant  a été supprimer",
                'data'=>$etudiant
            ]);
            
            
         }catch(Exception $exception){
            return response()->json($exception);
        }
    }
}
