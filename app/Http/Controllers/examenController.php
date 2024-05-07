<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamenRequest;
use App\Models\examen;
use Exception;
use Illuminate\Http\Request;

class examenController extends Controller
{
     /**
     * @OA\Get(
     *     path="/api/examen",
     *     tags={"examen"},
     *     summary="Get all examens for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="examenindex",
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
        $examen=examen::all();
        return $examen;
    }
     /**
     * @OA\Post(
     *     path="/api/examen/create",
     *     tags={"examen"},
     *     summary="create all examens for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="examenstore",
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
     *             @OA\Property(property="id_session", type="integer", example=""),
     *             @OA\Property(property="code_module", type="integer", example=""),
     *             @OA\Property(property="id_pv", type="integer", example=""),
     *             @OA\Property(property="date_examen", type="date", example=""),
     *            @OA\Property(property="demi_journee_examen", type="string", example="144488"),
     *             @OA\Property(property="seance_examen", type="string", example="")
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
     * )
     */
    public function store(ExamenRequest $request){

        try{
        $examen = new examen();
        $examen->id_session=$request->id_session;
        $examen->code_module=$request->code_module;
        $examen->id_pv=$request->id_pv;
        $examen->date_examen=$request->date_examen;
        $examen->demi_journee_examen=$request->demi_journee_examen;
        $examen->seance_examen=$request->seance_examen;
        $examen->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'l examen a été ajouté',
            'data'=>$examen
        ]);
        
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }
/**
     * @OA\Put(
     *     path="/api/examen/edit/{examen}",
     *     tags={"examen"},
     *     summary="update all examens for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="examenupdate",
     *    @OA\Parameter(
     *          name="examen",
     *          description="examen id",
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
     *             @OA\Property(property="id_session", type="integer", example=""),
     *             @OA\Property(property="code_module", type="integer", example=""),
     *             @OA\Property(property="id_pv", type="integer", example=""),
     *             @OA\Property(property="date_examen", type="date", example=""),
     *            @OA\Property(property="demi_journee_examen", type="string", example="144488"),
     *             @OA\Property(property="seance_examen", type="string", example="")
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
    public function update(examenRequest $request,examen $examen) {
        
        // $examen=$examen::find($id);

        try{
        
            $examen->id_session=$request->id_session;
            $examen->code_module=$request->code_module;
            $examen->id_pv=$request->id_pv;
            $examen->date_examen=$request->date_examen;
            $examen->demi_journee_examen=$request->demi_journee_examen;
            $examen->seance_examen=$request->seance_examen;
      
        $examen->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'la examen  a été modifié',
            'data'=>$examen
        ]);

        }catch(Exception $exception){
            return response()->json($exception);
        }
       
    }
/**
     * @OA\Delete(
     *     path="/api/examen/{examen}",
     *     tags={"examen"},
     *     summary="delete all examens for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="examendelete",
     *     @OA\Parameter(
     *          name="examen",
     *          description="examen id",
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
    public function delete(examen $examen) {
         try{
                $examen->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'la examen  a été supprimer',
                'data'=>$examen
            ]);
            
            
         }catch(Exception $exception){
            return response()->json($exception);
        }
    }
}
