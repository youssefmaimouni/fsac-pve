<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\signerRaquest;
use App\Models\signer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class signerController extends Controller
{
     /**
     * @OA\Get(
     *     path="/api/signer",
     *     tags={"signer"},
     *     summary="Get all signers for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="signerindex",
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
        $signer=signer::all();
        return $signer;
    }
     /**
     * @OA\Post(
     *     path="/api/signer/create",
     *     tags={"signer"},
     *     summary="create all signers for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="signerstore",
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
     *             @OA\Property(property="id_surveillant", type="integer", example=""),
     *             @OA\Property(property="id_pv", type="integer", example=""),
     *             @OA\Property(property="signer", type="string", example=""),
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
     * @OA\Response(
     *         response=401,
     *         description="Authentication information is missing or invalid"
     *     ),
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function store(signerRaquest $request)
    {
        try {
            $exists = DB::table('signers')
                ->where('id_surveillant', $request->id_surveillant)
                ->where('id_pv', $request->id_pv)
                ->exists();
    
            if ($exists) {
                return $this->update($request, $request->id_surveillant, $request->id_pv);
            } else {
                $signer = new Signer([
                    'id_surveillant' => $request->id_surveillant,
                    'id_pv' => $request->id_pv,
                    'signer' => $request->signer
                ]);
                $signer->save();
    
                return response()->json([
                    'status_code' => 201,
                    'status_message' => 'La signer a été ajouté avec succès.',
                    'data' => $signer
                ], 201);
            }
        } catch (Exception $exception) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Erreur lors de l\'ajout du signer.'
            ], 500);
        }
    }
    
    /**
     * @OA\Put(
     *     path="/api/signer/edit/{id_surveillant}/{id_pv}",
     *     tags={"signer"},
     *     summary="update all signers for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="signerupdate",
     *    @OA\Parameter(
     *          name="id_surveillant",
     *          description="surveillant id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * @OA\Parameter(
     *          name="id_pv",
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
     *             @OA\Property(property="id_surveillant", type="integer", example="144488"),
     *             @OA\Property(property="id_pv", type="integer", example=""),
     *             @OA\Property(property="signer", type="string", example=""),
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

    public function update(signerRaquest $request,$id_surveillant,$id_pv) {
        
        // $pv=$pv::find($id);

        try{
            $signer=signer::where('id_surveillant',$id_surveillant)->where('id_pv',$id_pv)->first();
            if ($signer != null) {
               DB::table('signers')->where('id_surveillant',$id_surveillant)
            ->where('id_pv',$id_pv)
            ->update(['id_surveillant'=>$request->id_surveillant,'id_pv'=>$request->id_pv,'signer'=>$request->signer]);

        return response()->json([
            'status_code'=>201,
            'status_message'=>'la signer  a été modifié',
            'data'=>$signer
        ]);
            } else {
                return response()->json([
                    'status_code' => 201,
                    'status_message' => 'la signer du id_surveillant et id_pv saisier n`existe pas',
                    'data' => $signer
                ]);
            }
            
           

        }catch(Exception $exeption){
            return response()->json($exeption);
        }
       
    }
/**
     * @OA\Delete(
     *     path="/api/signer/{id_surveillant}/{id_pv}",
     *     tags={"signer"},
     *     summary="delete all signers for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="signerdelete",
     *     @OA\Parameter(
     *          name="signer",
     *          description="signer id",
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
    public function delete(signer $signer,$id_surveillant,$id_pv) {
         try{
            $signer=signer::where('id_surveillant',$id_surveillant)->where('id_pv',$id_pv)->first();
            if ($signer != null) {
            $signer=DB::table('signers')->where('id_surveillant',$id_surveillant)
            ->where('id_pv',$id_pv)->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'la signer a été supprimer',
                'data'=>$signer
            ]);
        } else {
            return response()->json([
                'status_code' => 201,
                'status_message' => 'la signer du id_surveillant et id_pv saisier n`existe pas',
                'data' => $signer
            ]);
        }
        
            
         }catch(Exception $exeption){
            return response()->json($exeption);
        }
    }
}
