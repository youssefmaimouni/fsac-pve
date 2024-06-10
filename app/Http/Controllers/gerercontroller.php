<?php

namespace App\Http\Controllers;

use App\Http\Requests\gererRequest;
use App\Models\gerer;
use Exception;
use Illuminate\Support\Facades\DB;

class gererController extends Controller
{
    
    /**
     * @OA\Get(
     *     path="/api/gerer",
     *     tags={"gerer"},
     *     summary="Get gerer for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="indGerer",
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
            $gerer = Gerer::all();
            return response()->json($gerer);
        }
           /**
     * @OA\Post(
     *     path="/api/gerer/create",
     *     tags={"gerer"},
     *     summary="create all admins for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="storegerer",
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
     *             @OA\Property(property="id_session", type="integer", example="test@abc.com"),
     *             @OA\Property(property="id_administrateur", type="integer", example=""),
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
        public function store(gererRequest $request){
    
            try{
            $gerer = new gerer();
            $gerer->id_session=$request->id_session;
            $gerer->id_administrateur=$request->id_administrateur;   
            $gerer->save();
    
    
            return response()->json([
                'status_code'=>201,
                'status_message'=>'la gestion est ajoutee',
                'data'=>$gerer
            ]);
    
            }catch(Exception $exeption){
                return response()->json($exeption);
            }
    
        }
        
    /**
     * @OA\Put(
     *     path="/api/gerer/edit/{id_administrateur}/{id_session}",
     *     tags={"gerer"},
     *     summary="update all admins for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="updategerer",
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
     *          name="id_session",
     *          description="session id",
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
     *             @OA\Property(property="id_session", type="integer", example="test@abc.com"),
     *             @OA\Property(property="id_administrateur", type="integer", example=""),
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
    
        public function update(gererRequest $request,  $id_administrateur,$id_session) {
            try {
                $gerer = gerer::where('id_administrateur', $id_administrateur)
                ->where('id_session', $id_session)
                ->first();
                if ($gerer != null ) {
                   DB::table('gerers')->where('id_administrateur',$id_administrateur)
                ->where('id_session',$id_session)
                ->update(['id_administrateur'=>$request->id_administrateur,'id_session'=>$request->id_session]);
                
                $gerer = gerer::where('id_administrateur', $request->id_administrateur)
                ->where('id_session', $request->id_session)
                ->first();
                return response()->json([
                    'status_code' => 201,
                    'status_message' => 'La gestion a été modifiée',
                    'data' => $gerer
                ]);
                } else {
                    return response()->json([
                        'status_code' => 201,
                        'status_message' => 'la gestion du id_administrateur id_session saisier n`existe pas',
                        'data' => $gerer
                    ]);
                }
                
                
        
            } catch(Exception $exception) {
                return response()->json($exception);
            }
        }
        
    /**
     * @OA\Delete(
     *     path="/api/gerer/{id_administrateur}/{id_session}",
     *     tags={"gerer"},
     *     summary="suprimer la gestion for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="deletegerer",
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
     *          name="id_session",
     *          description="session id",
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
            public function delete(  $id_administrateur,$id_session) {
                try{
                    $gerer = gerer::where('id_administrateur', $id_administrateur)
                    ->where('id_session', $id_session)
                    ->first();
                    if ($gerer != null) {
                         DB::table('gerers')->where('id_administrateur',$id_administrateur)->where('id_session',$id_session)->delete();
                  
                         return response()->json([
                       'status_code'=>200,
                       'status_message' => 'la gestion a ete supprimer',
                       'data'=>$gerer
                        ]);
                    } else {
                         return response()->json([
                       'status_code'=>200,
                       'status_message' => 'la gestion du id_administrateur id_session saisier n`existe pas',
                       'data'=>$gerer
                        ]);
                    }
                    
                   
                   
                   
                }catch(Exception $exception){
                   return response()->json($exception);
               }
           }
        
}
