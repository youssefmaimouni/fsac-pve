<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditFiliereRequest;
use App\Http\Requests\CreateFiliereRequest;
use App\Models\filiere;
use Exception;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/filiere",
     *     tags={"filiere"},
     *     summary="Get all filieres for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="filiereindex",
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
        $filiere=filiere::all();
        return $filiere;
    }
    /**
     * @OA\Post(
     *     path="/api/filiere/create",
     *     tags={"filiere"},
     *     summary="create all filieres for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="filierestore",
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
     *            
     *            @OA\Property(property="nom_filiere", type="string", example="")
     *             
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
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function store(CreateFiliereRequest $request){

        try{
        $filiere = new filiere();
        $filiere->nom_filiere=$request->nom_filiere;
        $filiere->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'la filiére a été ajouté',
            'data'=>$filiere
        ]);
        
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }
/**
     * @OA\Put(
     *     path="/api/filiere/edit/{filiere}",
     *     tags={"filiere"},
     *     summary="update all filieres for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="filiereupdate",
     *    @OA\Parameter(
     *          name="filiere",
     *          description="filiere id",
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
     *             @OA\Property(property="nom_filiere", type="string", example="")
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
    public function update(EditFiliereRequest $request,filiere $filiere) {
        
        // $filiere=$filiere::find($id);

        try{
        
        $filiere->nom_filiere=$request->nom_filiere;
      
        $filiere->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'la filiere  a été modifié',
            'data'=>$filiere
        ]);

        }catch(Exception $exception){
            return response()->json($exception);
        }
       
    }
/**
     * @OA\Delete(
     *     path="/api/filiere/{filiere}",
     *     tags={"filiere"},
     *     summary="delete all filieres for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="filieredelete",
     *     @OA\Parameter(
     *          name="filiere",
     *          description="filiere id",
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
    public function delete(filiere $filiere) {
         try{
                $filiere->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'la filiere  a été supprimer',
                'data'=>$filiere
            ]);
            
            
         }catch(Exception $exception){
            return response()->json($exception);
        }
    }
}
