<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamenRequest;
use App\Http\Requests\GetEtudiantsRequest;
use App\Http\Requests\repartitionRequest;
use App\Models\etudiant;
use App\Models\Examen;
use App\Models\surveillant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamenController extends Controller
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
     *     ),@OA\Response(
     *         response=401,
     *         description="Authentication information is missing or invalid"
     *     ),
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function getEtudiants(GetEtudiantsRequest $request)
    {
        try{
            $etudiants = etudiant::select('etudiants.nom_etudiant', 'etudiants.prenom_etudiant', 'etudiants.CNE','etudiants.codeApogee','passers.num_exam')
                                   ->join('passers', 'etudiants.codeApogee', '=', 'passers.codeApogee')
                                   ->join('examens', 'examens.id_examen', '=', 'passers.id_examen')
                                   ->where('examens.demi_journee_examen', '=',  $request->demi_journee)
                                   ->where('examens.date_examen', '=', $request->date_examen)
                                   ->where('passers.id_local','=',$request->id_local) 
                                   ->get();
                                   return response()->json([
                                    'status_code' => 201,
                                    'data' => $etudiants
                                ]);
                            } catch (Exception $exception) {
                                return response()->json($exception);
                            }
    }

    // Méthode pour récupérer les surveillants d'un examen spécifique
    public function getSurveillants(repartitionRequest $request)
    {
       
        try{
        $surveillants = surveillant::select('surveillants.nomComplet_s', 'surveillants.id_surveillant','surveillants.id_departement')
                        ->join('associers', 'surveillants.id_surveillant', '=', 'associers.id_surveillant')
                        ->join('affectations', 'affectations.id_affectation', '=', 'associers.id_affectation')
                        ->join('locals', 'locals.id_local', '=', 'affectations.id_local')
                        ->where('affectations.demi_journee_affectation', '=', $request->demi_journee)
                        ->where('affectations.date_affectation', '=', $request->date_affectation)
                        ->where('locals.id_local','=',$request->id_local)
                        ->get();
            

            return response()->json([
                'status_code' => 201,
                'data' => $surveillants
            ]);
        } catch (Exception $exception) {
            return response()->json($exception);
        }
    }

    public function index()
    {
        $examens = Examen::all();
        return $examens;
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
     *         description="Examen data that needs to be added to the store",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id_session", type="integer", example="1"),
     *             @OA\Property(property="code_module", type="integer", example="101"),
     *             @OA\Property(property="id_pv", type="integer", example="2"),
     *             @OA\Property(property="date_examen", type="string", format="date", example="2024-06-01"),
     *             @OA\Property(property="demi_journee_examen", type="string", example="AM"),
     *             @OA\Property(property="seance_examen", type="string", example="1")
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
    public function store(ExamenRequest $request)
    {
        try {
            $examen = new Examen();
            $examen->id_session = $request->id_session;
            $examen->code_module = $request->code_module;
            $examen->id_pv = $request->id_pv;
            $examen->date_examen = $request->date_examen;
            $examen->demi_journee_examen = $request->demi_journee_examen;
            $examen->seance_examen = $request->seance_examen;
            $examen->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'L examen a été ajouté',
                'data' => $examen
            ]);
        } catch (Exception $exception) {
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
     *         description="Examen data that needs to be updated",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id_session", type="integer", example="1"),
     *             @OA\Property(property="code_module", type="integer", example="101"),
     *             @OA\Property(property="id_pv", type="integer", example="2"),
     *             @OA\Property(property="date_examen", type="string", format="date", example="2024-06-01"),
     *             @OA\Property(property="demi_journee_examen", type="string", example="AM"),
     *             @OA\Property(property="seance_examen", type="string", example="1")
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
    public function update(ExamenRequest $request, Examen $examen)
    {
        try {
            $examen->id_session = $request->id_session;
            $examen->code_module = $request->code_module;
            $examen->id_pv = $request->id_pv;
            $examen->date_examen = $request->date_examen;
            $examen->demi_journee_examen = $request->demi_journee_examen;
            $examen->seance_examen = $request->seance_examen;
            $examen->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'L examen a été modifié',
                'data' => $examen
            ]);
        } catch (Exception $exception) {
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
     * @OA\Response(
     *         response=401,
     *         description="Authentication information is missing or invalid"
     *     ),
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function delete(Examen $examen)
    {
        try {
            $examen->delete();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'L examen a été supprimé',
                'data' => $examen
            ]);
        } catch (Exception $exception) {
            return response()->json($exception);
        }
    }
}
