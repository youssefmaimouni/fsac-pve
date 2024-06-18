<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\editpasserRequest;
use App\Http\Requests\EtatRequest;
use App\Http\Requests\getPVRequest;
use App\Http\Requests\RapportRequest;
use App\Http\Requests\signerRaquest;
use App\Http\Requests\setPVRequest;
use App\Http\Requests\tabletteRequest;
use App\Models\affectation;
use App\Models\etudiant;
use App\Models\session;
use App\Models\surveillant;
use App\Models\tablette;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class tabletteController extends RoutingController
{
     /**
     * @OA\Get(
     *     path="/api/tablette",
     *     tags={"Tablette"},
     *     summary="afficher toute les tablettes for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="indexTablette",
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
        $tablette = tablette::all();
        return response()->json($tablette);
    }
    /**
     * @OA\Post(
     *     path="/api/tablette/create",
     *     tags={"Tablette"},
     *     summary="ajouter une tablette pour REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="storetablette",
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
     *         description="les donnees d'une tablette",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="device_id", type="string", example="")
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
    public function store(tabletteRequest $request){

        try{
            $exists = DB::table('tablettes')
                ->where('device_id', $request->device_id)
                ->exists();
            if ($exists) {
                $tablette=tablette::where('device_id', $request->device_id)->first();
                    if ($tablette->statut='bloquer') {
                        return response()->json([
                            'status_code'=>201,
                            'status_message'=>"tablette a été bloquer",
                            'data'=>$tablette
                        ]);
                    }
                $tablette->device_id=$request->device_id;
                $tablette->code_association=$request->code_association;
                $tablette->save();
            }else{
                $tablette = new tablette();
                $tablette->id_tablette=$request->id_tablette;
                $tablette->device_id=$request->device_id;
                $tablette->statut='non associer';
                $tablette->code_association=$request->code_association;
                $tablette->save();
            }
    
            return response()->json([
                'status_code'=>201,
                'status_message'=>"tablette a été ajouté",
                'data'=>$tablette
            ]);
            
            }catch(Exception $exception){
                return response()->json($exception);
            }
        
    }
    /**
     * @OA\Put(
     *     path="/api/tablette/edit/{tablette}",
     *     tags={"Tablette"},
     *     summary="midifier les donnee d'une tablette pour REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="updatetablette",
     *    @OA\Parameter(
     *          name="tablette",
     *          description="tablette id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *         description="les donnees de tablette",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="device_id", type="string", example=""),
     *             @OA\Property(property="statut", type="string", example=""),
     *             @OA\Property(property="code_association", type="integer", example="")
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
     *         response=404,
     *         description="Data not found"
     *     ),
     * @OA\Response(
     *         response=401,
     *         description="Authentication information is missing or invalid"
     *     ),
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function update(tabletteRequest $request,tablette $tablette) {
        
        try{
            $tablette->device_id=$request->device_id;
            $tablette->statut=$request->statut;
            $tablette->code_association=$request->code_association;
            $tablette->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'le surveillant  a été modifié',
            'data'=>$tablette
        ]);

        }catch(Exception $exception){
            return response()->json($exception);
        }
    }
    /**
     * @OA\Delete(
     *     path="/api/tablette/{tablette}",
     *     tags={"Tablette"},
     *     summary="delete all tablettes for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="delete tablette",
     *     @OA\Parameter(
     *          name="tablette",
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
    public function delete(tablette $tablette) {
        try{
            $tablette->delete();
            
            return response()->json([
                'status_code'=>200,
                'status_message'=>'tablette est supprimer avec succes',
                'data'=>$tablette
            ]);
            
            
        }catch(Exception $exception){
            return response()->json($exception);
        }
    }
    
    /**
     * @OA\POST(
     *     path="/api/tablette/getEtat",
     *     tags={"Tablette"},
     *     summary="delete all tablettes for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="get adress mac tablette",
     *    @OA\Parameter(
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
     *     @OA\RequestBody(
     *         description="les donnees de tablette",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="device_id", type="string", example="")
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
     *       security={{"bearerAuth":{}}}
     * )
     */
    public function getEtat(EtatRequest $request){
        try{

            $exists = DB::table('tablettes')
                ->where('device_id', $request->device_id)
                ->exists();
            if ($exists) {
               $etat= DB::table('tablettes')
               ->where('device_id', $request->device_id)
               ->value('statut');
               return response()->json([
                'statut'=>$etat
               ]);  
            }else {
                return response()->json([
                    'statut'=>null
                   ]); 
            }
        }catch(Exception $exception){
            return response()->json($exception);
        }
        }
    /**
     * @OA\POST(
     *     path="/api/tablette/getPV",
     *     tags={"Tablette"},
     *     summary="delete all tablettes for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="get PV du tablette",
     *    @OA\Parameter(
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
     *     @OA\RequestBody(
     *         description="les donnees de tablette",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="device_id", type="string", example=""),
     *             @OA\Property(property="demi_journee", type="string", example="AM/PM"),
     *             @OA\Property(property="date", type="date", example="yyyy-mm-dd")
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
     *       security={{"bearerAuth":{}}}
     * )
     */
        public function getPV(getPVRequest $request){
            try{

                $exists = DB::table('tablettes')
                    ->where('device_id', $request->device_id)
                    ->exists();
                if ($exists) {
                   $etat= DB::table('tablettes')
                   ->where('device_id',$request->device_id)
                   ->value('statut');
                   if($etat=='associer'){
                    $surveillants = tablette::select('surveillants.nomComplet_s', 'surveillants.id_surveillant','surveillants.id_departement')
                               ->join('affectations', 'affectations.id_tablette', '=', 'tablettes.id_tablette')
                               ->join('associers', 'affectations.id_affectation', '=', 'associers.id_affectation')
                               ->join('surveillants', 'surveillants.id_surveillant', '=', 'associers.id_surveillant')
                               ->join('locals', 'locals.id_local', '=', 'affectations.id_local')
                               ->where('affectations.demi_journee_affectation', '=', $request->demi_journee)
                               ->where('affectations.date_affectation', '=', $request->date)
                               ->where('tablettes.device_id','=',$request->device_id)
                               ->where('locals.type_local', '!=', 'R')
                               ->get();
                    $reserviste = surveillant::select('surveillants.nomComplet_s', 'surveillants.id_surveillant','surveillants.id_departement')
                               ->join('associers', 'surveillants.id_surveillant', '=', 'associers.id_surveillant')
                               ->join('affectations', 'affectations.id_affectation', '=', 'associers.id_affectation')
                               ->join('locals', 'locals.id_local', '=', 'affectations.id_local')
                               ->where('affectations.demi_journee_affectation', '=', $request->demi_journee)
                               ->where('affectations.date_affectation', '=', $request->date)
                               ->where('locals.type_local','=','R')
                               ->get();
                    $local = tablette::select('locals.id_local', 'locals.num_local','locals.type_local')
                               ->join('affectations', 'affectations.id_tablette', '=', 'tablettes.id_tablette')
                               ->join('locals', 'locals.id_local', '=', 'affectations.id_local')
                               ->where('affectations.demi_journee_affectation', '=', $request->demi_journee)
                               ->where('affectations.date_affectation', '=', $request->date)
                               ->where('tablettes.device_id','=',$request->device_id)
                               ->get();
                    $etudiantsS1 = etudiant::select('etudiants.nom_etudiant', 'etudiants.prenom_etudiant', 'etudiants.CNE','etudiants.codeApogee','passers.num_exam')
                               ->join('passers', 'etudiants.codeApogee', '=', 'passers.codeApogee')
                               ->join('examens', 'examens.id_examen', '=', 'passers.id_examen')
                               ->where('examens.demi_journee_examen', '=', $request->demi_journee)
                               ->where('examens.date_examen', '=', $request->date)
                               ->where('examens.seance_examen', '=', 'S1')
                               ->where('passers.id_local','=',$local[0]->id_local) 
                               ->get(); 
                    $etudiantsS2 = etudiant::select('etudiants.nom_etudiant', 'etudiants.prenom_etudiant', 'etudiants.CNE','etudiants.codeApogee','passers.num_exam')
                               ->join('passers', 'etudiants.codeApogee', '=', 'passers.codeApogee')
                               ->join('examens', 'examens.id_examen', '=', 'passers.id_examen')
                               ->where('examens.demi_journee_examen', '=', $request->demi_journee)
                               ->where('examens.date_examen', '=', $request->date)
                               ->where('examens.seance_examen', '=', 'S2')
                               ->where('passers.id_local','=',$local[0]->id_local) 
                               ->get(); 
                    $session=session::select('examens.id_examen','sessions.nom_session','sessions.type_session','sessions.Annee_universitaire','examens.date_examen','examens.demi_journee_examen','examens.seance_examen','modules.intitule_module','examens.id_pv')
                               ->distinct()
                                ->join('examens', 'examens.id_session', '=', 'sessions.id_session')
                               ->join('passers', 'examens.id_examen', '=', 'passers.id_examen')
                               ->join('modules','examens.code_module','=','modules.code_module')
                               ->where('examens.demi_journee_examen', '=', $request->demi_journee)
                               ->where('examens.date_examen', '=', $request->date)
                               ->where('passers.id_local','=',$local[0]->id_local)
                               ->get();
                               $PV = [
                                   'local' => $local,
                                   'surveillants' => $surveillants,
                                   'reserviste' => $reserviste,
                                   'etudiantsS1' => $etudiantsS1,
                                   'etudiantsS2' => $etudiantsS2,
                                   'session' => $session
                                ];
                        
                    return response()->json([
                                'status_code'=>201,
                                'status_message'=>'tablette  associer',
                                'PV'=>$PV
                               ]); 
                   }else {
                    return response()->json([
                        'status_code'=>400,
                        'status_message'=>'tablette non associer',
                        'PV'=>null
                       ]); 
                   }
                }else {
                    return response()->json([
                        'status_code'=>400,
                        'status_message'=>'tablette  n`existe pas dans la base de donnée',
                        'PV'=>null
                       ]); 
                }
            }catch(Exception $exception){
                return response()->json($exception);
            }
        }
        public function setPV(setPVRequest $request,RapportController $rapportController,passerController $passerController,signerController $signerController){
            try{
                    $rapports=$request->rapports;
                    $passers=$request->passers;
                    $signers=$request->signers;
                    if ($rapports != null) {
                        
                        foreach ($rapports as $rapport) {
                            
                            $rapportRequest = new RapportRequest();
                            $rapportRequest->replace($rapport); 
                
                            $response = $rapportController->store($rapportRequest);
                
                            if ($response instanceof JsonResponse) {
                                $responseData = json_decode($response->getContent(), true);
                                if ($responseData['status_code'] != 201) {
                                    throw new Exception($responseData['status_message'], $responseData['status_code']);
                                }
                            } else {
                                throw new Exception('Unexpected response type');
                            }
                        }
                    
                    }
                    foreach ($passers as $passer) {
                        $passerRequest = new editpasserRequest();
                        $passerRequest->replace($passer); 
            
                        $response = $passerController->update($passerRequest, $passer['id_examen'], $passer['id_local'], $passer['codeApogee']);
                        if ($response instanceof JsonResponse) {
                            $responseData = json_decode($response->getContent(), true);
                            if ($responseData['status_code'] != 201) {
                                throw new Exception($responseData['status_message'], $responseData['status_code']);
                                }
                                } else {
                                    throw new Exception('Unexpected response type');
                                    }
                                    }
                                    
                     
                    foreach ($signers as $signer) {
                        $signerRequest = new signerRaquest();
                        $signerRequest->replace($signer); 
                        
                        $response = $signerController->store($signerRequest);
                        if ($response instanceof JsonResponse) {
                            $responseData = json_decode($response->getContent(), true);
                            if ($responseData['status_code'] != 201) {
                                throw new Exception($responseData['status_message'], $responseData['status_code']);
                            }
                        } else {
                            throw new Exception('Unexpected response type');
                        }
                    }
                    
                    
                    return response()->json([
                        'status_code'=>201,
                        'status_message'=>'le pv a éte enregistre dans la base de donnee'
                        ]);
                    
            }catch(Exception $exception){
                return response()->json([
                    'status_code' => $exception->getCode() ?: 400,
                    'status_message' => $exception->getMessage()
                ]);
            }
        }
        public function getPhoto($filename)
{
    $path = storage_path('app/public/photos/' . $filename.'.jpeg');

    if (!File::exists($path)) {
        abort(404);
    }

    $fileData = file_get_contents($path);
    $base64 = base64_encode($fileData);
    $type = File::mimeType($path);

    return response()->json(['image' => 'data:' . $type . ';base64,' . $base64]);
}

}  


        
