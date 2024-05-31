<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller ;
use App\Http\Requests\controlerRequest ;
use App\Models\Controler ;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControlerController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/controler",
     *     tags={"controler"},
     *     summary="Get controler for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="indCont",
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
        $controler = Controler::all();
        return response()->json($controler);
    }
      /**
     * @OA\Post(
     *     path="/api/controler/create",
     *     tags={"controler"},
     *     summary="ajouter un controler for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="storecont",
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
     *         description="les donnee de controler",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id_tablette", type="integer", example=""),
     *             @OA\Property(property="id_administrateur", type="integer", example="")
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
    public function store(controlerRequest $request){

        try { 
            $controler= new controler();
            $controler->id_administrateur=$request->id_administrateur;
            $controler->id_tablette=$request->id_tablette;
            $controler->save();
    
        
            return response()->json([
                'status_code'=>201,
                'status_message'=>'Controler a été ajouté',
                'data'=>$controler
            ]);
        
         }catch(Exception $exeption){
            return response()->json($exeption);
        }
        
    } 
    /**
     * @OA\Put(
     *     path="/api/controler/edit/{id_administrateur}/{id_tablette}",
     *     tags={"controler"},
     *     summary="update all admins for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="updatecont",
     *    @OA\Parameter(
     *          name="id_administrateur",
     *          description="administrateur id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="id_tablette",
     *          description="tablette id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *       @OA\RequestBody(
     *         description="les donnee de controler",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id_administrateur", type="integer", example=""),
     *             @OA\Property(property="id_tablette", type="integer", example="")
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

    public function update(ControlerRequest $request,$id_administrateur ,$id_tablette ) {
        

        try{
            $controler = Controler::where('id_administrateur', $id_administrateur)
            ->where('id_tablette', $id_tablette)
            ->first();
        if ($controler != null ) {
             DB::table('controlers')->where('id_administrateur',$id_administrateur)
            ->where('id_tablette',$id_tablette)
            ->update(['id_administrateur'=>$request->id_administrateur,'id_tablette'=>$request->id_tablette]);
            $controler = Controler::where('id_administrateur', $request->id_administrateur)
            ->where('id_tablette', $request->id_tablette)
            ->first();
            
        return response()->json([
            'status_code'=>201,
            'status_message'=>'Controler a été modifié',
            'data'=>$controler
        ]);
        } else {
            return response()->json([
                'status_code' => 201,
                'status_message' => 'la controler du id_administrateur id_session saisier n`existe pas',
                'data' => $controler
            ]);
        }
        
           

        }catch(Exception $exeption){
            return response()->json($exeption);
        }
       
    }
    /**
     * @OA\Delete(
     *     path="/api/controler/{id_administrateur}/{id_tablette}",
     *     tags={"controler"},
     *     summary="suprimer la gestion for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="deletecont",
     *     @OA\Parameter(
     *          name="id_administrateur",
     *          description="administrateur id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *    @OA\Parameter(
     *          name="id_tablette",
     *          description="tablette id",
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
    public function delete(  $id_administrateur,$id_tablette) {
        try{

            $controler = Controler::where('id_administrateur', $id_administrateur)
            ->where('id_tablette', $id_tablette)
            ->first();
            if ($controler != null) {
                DB::table('controlers')->where('id_administrateur',$id_administrateur)->where('id_tablette',$id_tablette)->delete();

           return response()->json([
               'status_code'=>200,
               'status_message'=>'la gestion  a été supprimer',
               'data'=>$controler
           ]);
            } else {
                return response()->json([
                    'status_code' => 201,
                    'status_message' => 'la controler du id_administrateur id_session saisier n`existe pas',
                    'data' => $controler
                ]);
            }
            
            
           
           
        }catch(Exception $exception){
           return response()->json($exception);
       }
   }
} 