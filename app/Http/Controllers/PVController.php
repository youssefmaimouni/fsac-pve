<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PVRequest;
use App\Models\etudiant;
use App\Models\pv;
use App\Models\session;
use App\Models\surveillant;
use App\Models\Tablette;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PVController extends Controller
{
     /**
     * @OA\Get(
     *     path="/api/pv",
     *     tags={"Pv"},
     *     summary="Get all Pvs for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="pvindex",
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
        $pv=pv::all();
        return $pv;
    }
    
     /**
     * @OA\Post(
     *     path="/api/pv/create",
     *     tags={"Pv"},
     *     summary="create all pvs for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="pvstore",
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
     *             @OA\Property(property="id_tablette", type="integer", example="144488"),
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
    public function store(PVRequest $request){

        try{
        $pv = new pv();
        $pv->id_tablette=$request->id_tablette;
        $pv->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'le PV a été ajouté',
            'data'=>$pv
        ]);
        
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }
   /**
     * @OA\Put(
     *     path="/api/pv/edit/{pv}",
     *     tags={"Pv"},
     *     summary="update all pvs for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="pvupdate",
     *    @OA\Parameter(
     *          name="pv",
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
     *             @OA\Property(property="id_tablette", type="integer", example="144488"),
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
    public function update(PVRequest $request,pv $pv) {
        
        // $pv=$pv::find($id);

        try{
        
        $pv->id_tablette=$request->id_tablette;
      
        $pv->save();

        return response()->json([
            'status_code'=>201,
            'status_message'=>'le PV  a été modifié',
            'data'=>$pv
        ]);

        }catch(Exception $exeption){
            return response()->json($exeption);
        }
       
    }
/**
     * @OA\Delete(
     *     path="/api/pv/{pv}",
     *     tags={"Pv"},
     *     summary="delete all pvs for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="pvdelete",
     *     @OA\Parameter(
     *          name="pv",
     *          description="pv id",
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
    public function delete(pv $pv) {
         try{
                $pv->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'le PV  a été supprimer',
                'data'=>$pv
            ]);
            
            
         }catch(Exception $exeption){
            return response()->json($exeption);
        }
    }

    public function getPV(Request $request){
        try{
                $surveillants = Tablette::select('surveillants.nomComplet_s', 'surveillants.id_surveillant','surveillants.id_departement')
                           ->join('affectations', 'affectations.id_tablette', '=', 'tablettes.id_tablette')
                           ->join('associers', 'affectations.id_affectation', '=', 'associers.id_affectation')
                           ->join('surveillants', 'surveillants.id_surveillant', '=', 'associers.id_surveillant')
                           ->where('affectations.demi_journee_affectation', '=', $request->demi_journee)
                           ->where('affectations.date_affectation', '=', $request->date)
                           ->where('tablettes.device_id','=',$request->device_id)
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
                $etudiantsP = etudiant::select('etudiants.nom_etudiant', 'etudiants.prenom_etudiant', 'etudiants.CNE','etudiants.codeApogee','passers.num_exam')
                           ->join('passers', 'etudiants.codeApogee', '=', 'passers.codeApogee')
                           ->join('examens', 'examens.id_examen', '=', 'passers.id_examen')
                           ->where('examens.demi_journee_examen', '=', $request->demi_journee)
                           ->where('examens.date_examen', '=', $request->date)
                           ->where('passers.id_local','=',$local[0]->id_local) 
                           ->get(); 
                $etudiantsA = etudiant::select('etudiants.nom_etudiant', 'etudiants.prenom_etudiant', 'etudiants.CNE','etudiants.codeApogee','passers.num_exam')
                           ->join('passers', 'etudiants.codeApogee', '=', 'passers.codeApogee')
                           ->join('examens', 'examens.id_examen', '=', 'passers.id_examen')
                           ->where('examens.demi_journee_examen', '=', $request->demi_journee)
                           ->where('examens.date_examen', '=', $request->date)
                           ->where('passers.id_local','=',$local[0]->id_local) 
                           ->get(); 
                $session=session::select('sessions.nom_session','sessions.type_session','sessions.Annee_universitaire','examens.date_examen','examens.demi_journee_examen','examens.seance_examen','modules.intitule_module')
                        ->distinct()
                        ->join('examens', 'examens.id_session', '=', 'sessions.id_session')
                        ->join('passers', 'examens.id_examen', '=', 'passers.id_examen')
                        ->join('modules','examens.code_module','=','modules.code_module')
                        ->where('examens.demi_journee_examen', '=', $request->demi_journee)
                        ->where('examens.date_examen', '=', $request->date)
                        ->where('passers.id_local','=',$local[0]->id_local)
                        ->get();
                return response()->json([
                            'status_code'=>201,
                            'local' => $local,
                            'surveillants' => $surveillants,
                            'reserviste' => $reserviste,
                            'etudiantsP' => $etudiantsP,
                            'etudiantsA' => $etudiantsA,
                            'session' => $session
                           ]); 
        }catch(Exception $exception){
            return response()->json($exception);
        }
    }
}
