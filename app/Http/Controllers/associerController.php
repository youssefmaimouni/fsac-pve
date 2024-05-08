<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssocierRequest;
use App\Models\associer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class associerController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/associer",
     *     tags={"associer"},
     *     summary="Get associer for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="indexassocier",
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
        $associer = associer::all();
        return response()->json($associer);
    }
    /**
     * @OA\Post(
     *     path="/api/associer/create",
     *     tags={"associer"},
     *     summary="create all admins for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="storeassocier",
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
     *             @OA\Property(property="id_surveillant", type="integer", example="test@abc.com"),
     *             @OA\Property(property="id_affectation", type="integer", example=""),
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
    public function store(AssocierRequest $request){

        try{
        $associer = new associer();
        $associer->id_surveillant=$request->id_surveillant;
        $associer->id_affectation=$request->id_affectation;
        

        $associer->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'associer a été ajouté',
            'data'=>$associer
        ]);
        
        }catch(Exception $exeption){
            return response()->json($exeption);
        }
        
    }
    /**
     * @OA\Put(
     *     path="/api/associer/edit/{id_surveillant}/{id_affectation}",
     *     tags={"associer"},
     *     summary="update all admins for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="updateassocier",
     *    @OA\Parameter(
     *          name="id_surveillant",
     *          description="surveillant id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="id_affectation",
     *          description="affectation id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *       @OA\RequestBody(
     *         description="Book data that needs to be added to the store",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id_surveillant", type="integer", example="test@abc.com"),
     *             @OA\Property(property="id_affectation", type="integer", example=""),
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
    public function update(AssocierRequest $request,$id_surveillant,$id_affectation) {
        

        try{
            $associer = associer::where('id_surveillant', $id_surveillant)
            ->where('id_affectation', $id_affectation)
            ->first();
        if ($associer != null) {
                DB::table('associers')->where('id_surveillant',$id_surveillant)->where('id_affectation',$id_affectation)
            ->update([
                "id_surveillant"=>$request->id_surveillant,
                "id_affectation"=>$request->id_affectation
            ]);
           
 

        return response()->json([
            'status_code'=>201,
            'status_message'=>'associer  a été modifié',
            'data'=>$associer
        ]);
           
            } else {
                return response()->json([
                    'status_code'=>200,
                    'status_message' => 'la association du id_affectation id_surveillant saisier n`existe pas',
                    'data'=>$associer
                     ]);
            }

        }catch(Exception $exception){
            return response()->json($exception);
        }
       
    }
    /**
     * @OA\Delete(
     *     path="/api/associer/{id_surveillant}/{id_affectation}",
     *     tags={"associer"},
     *     summary="suprimer la gestion for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="deleteassocier",
     *     @OA\Parameter(
     *          name="id_surveillant",
     *          description="surveillant id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *    @OA\Parameter(
     *          name="id_affectation",
     *          description="affectation id",
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
    public function delete($id_surveillant,$id_affectation) {
        try{  
            $associer = associer::where('id_surveillant', $id_surveillant)
                    ->where('id_affectation', $id_affectation)
                    ->first();
            if ($associer != null) {
                
            DB::table('associers')->where('id_surveillant',$id_surveillant)->where('id_affectation',$id_affectation)->delete();
    
           return response()->json([
               'status_code'=>200,
               'status_message'=>'la associer  a été supprimer',
               'data'=>$associer
           ]);
            } else {
                return response()->json([
                    'status_code'=>200,
                    'status_message' => 'la association du id_affectation id_surveillant saisier n`existe pas',
                    'data'=>$associer
                     ]);
            }
            
           
           
        }catch(Exception $exception){
           return response()->json($exception);
       }
    }
}
