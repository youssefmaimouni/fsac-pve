<?php

namespace App\Http\Controllers;
use App\Http\Requests\administrateurRequest;
use App\Models\administrateur;
use Exception;
use PhpParser\Node\Stmt\TryCatch;

class administrateurController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/administrateur",
     *     tags={"Admin"},
     *     summary="Get all admins for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="index",
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
        return 'Liste des Administrateurs';
    }
    /**
     * @OA\Post(
     *     path="/api/administrateur/create",
     *     tags={"Admin"},
     *     summary="create all admins for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="store",
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
    public function store(administrateurRequest $request){

        try{
        $administrateur = new Administrateur();
        $administrateur->mail=$request->mail;
        $administrateur->nom=$request->nom;
        $administrateur->prenom=$request->prenom;
        $administrateur->mot_de_passe =bcrypt( $request->mot_de_passe);
        $administrateur->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'authentification validee',
            'data'=>$administrateur
        ]);
        
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }
    /**
     * @OA\Put(
     *     path="/api/administateur/edit/{id_administateur}",
     *     tags={"Admin"},
     *     summary="update all admins for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="update",
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
    public function update(administrateurRequest $request,administrateur $administrateur )
    {
        try{
            $administrateur->mail=$request->mail;
        $administrateur->nom=$request->nom;
        $administrateur->prenom=$request->prenom;
        $administrateur->save();
        return response()->json([
            'status_code'=>200,
            'status_message'=>'l\'administrateur a été modifier',
            'data'=>$administrateur
        ]);
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }
    public function update_mot_de_passe(administrateurRequest $request,administrateur $administrateur )
    {
        try{
        $administrateur->mot_de_passe = bcrypt($request->mot_de_passe);
        $administrateur->save();
        return response()->json([
            'status_code'=>200,
            'status_message'=>'le mot de passe de l\'admin a été modifier',
            'data'=>$administrateur
        ]);
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }
/**
     * @OA\Delete(
     *     path="/api/administrateur/{administrateur}",
     *     tags={"Admin"},
     *     summary="delete all admins for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="delete",
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
public function delete(administrateur  $administrateur) {
         try{
                $administrateur->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'l\'administrateur a été supprimer',
                'data'=>$administrateur
            ]);
            
            
         }catch(Exception $exeption){
            return response()->json($exeption);
        }
    }
}

