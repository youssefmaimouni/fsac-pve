<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateModuleRequest;
use App\Http\Requests\EditModuleRequest;
use App\Models\module;
use Exception;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/module",
     *     tags={"module"},
     *     summary="Get all modules for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="moduleindex",
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
         $modules = module::all();
         return $modules;
    }
     /**
     * @OA\Post(
     *     path="/api/module/create",
     *     tags={"module"},
     *     summary="create all modules for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="modulestore",
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
     *            @OA\Property(property="id_filiere", type="integer", example=""),
     *            @OA\Property(property="intitule_module", type="string", example="")
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
     * )
     */

    public function store(CreateModuleRequest $request){

        try{
        $module = new module();
        $module->intitule_module=$request->intitule_module;  
        $module->id_filiere=$request->id_filiere;

        $module->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'le module a été ajouté',
            'data'=>$module
        ]);
        
        }catch(Exception $exeption){
            return response()->json($exeption);
        }
        
    }
    /**
     * @OA\Put(
     *     path="/api/module/edit/{module}",
     *     tags={"module"},
     *     summary="update all modules for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="moduleupdate",
     *    @OA\Parameter(
     *          name="module",
     *          description="module id",
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
     *             @OA\Property(property="id_filiere", type="integer", example=""),
     *            @OA\Property(property="intitule_module", type="string", example="")
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
    public function update(EditModuleRequest $request,module $module) {
        

        try{
        
        $module->intitule_module=$request->intitule_module;
        $module->id_filiere=$request->id_filiere;
      
        $module->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'la module  a été modifié',
            'data'=>$module
        ]);

        }catch(Exception $exeption){
            return response()->json($exeption);
        }
       
    }
    /**
     * @OA\Delete(
     *     path="/api/module/{module}",
     *     tags={"module"},
     *     summary="delete all modules for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="moduledelete",
     *     @OA\Parameter(
     *          name="module",
     *          description="module id",
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

    public function delete(module $module) {
         try{
                $module->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'le module  a été supprimer',
                'data'=>$module
            ]);
            
            
         }catch(Exception $exception){
            return response()->json($exception);
        }
    }
}
