<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\gPVRequest;
use App\Http\Requests\PVRequest;
use App\Models\etudiant;
use App\Models\examen;
use App\Models\local;
use App\Models\module;
use App\Models\pv;
use App\Models\Tablette;
use App\Models\Rapport;
use App\Models\session;
use App\Models\surveillant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
    /**
     * @OA\Post(
     *     path="/api/pv/upload",
     *     tags={"Pv"},
     *     summary="Upload a PDF and update the corresponding PV entry",
     *     description="Upload a PDF and associate it with a tablette using MAC address",
     *     operationId="uploadPDF",
     *     @OA\RequestBody(
     *         description="PDF file to upload and device_id",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(property="pdf", type="string", format="binary"),
     *                 @OA\Property(property="device_id", type="string", example="00:0a:95:9d:68:16")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="File uploaded and updated successfully",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No matching tablette entry found for the given device_id"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Authentication information is missing or invalid"
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function uploadPDF(Request $request)
    {
        $request->validate([
            'pdf' => 'required|file|mimes:pdf',
            'device_id' => 'required|string|exists:tablettes,device_id',
        ]);

        if ($request->hasFile('pdf')) {
            $path = $request->file('pdf')->store('pdfs');


            $tablette = Tablette::where('device_id', $request->input('device_id'))->first();

            if ($tablette) {

                    $pv = new PV();
                    $pv->file_path = $path;
                    $pv->id_tablette = $tablette->id_tablette;
                    $pv->save();

                return response()->json(['message' => 'File uploaded and updated successfully', 'path' => $path], 200);
            } else {
                return response()->json(['message' => 'No matching tablette entry found for the given device_id'], 404);
            }
        }

        return response()->json(['message' => 'No file uploaded'], 400);
    }


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

    public function getPV(gPVRequest $request)
    {
        try {
            $exists = DB::table('locals')
                ->where('id_local', $request->id_local)
                ->exists();
    
            if ($exists) {
    
    
                $examen1= examen::select('examens.date_examen','examens.demi_journee_examen')
                    ->join('passers', 'examens.id_examen', '=', 'passers.id_examen')
                    ->where('examens.demi_journee_examen', '=', $request->demi_journee)
                    ->where('examens.date_examen', '=', $request->date)
                    ->where('passers.id_local', '=', $request->id_local)
                    ->get();
    
                $module1 = module::select('modules.intitule_module')
                    ->join('examens', 'modules.code_module', '=', 'examens.code_module')
                    ->join('passers', 'examens.id_examen', '=', 'passers.id_examen')
                    ->where('examens.demi_journee_examen', '=', $request->demi_journee)
                    ->where('examens.date_examen', '=', $request->date)
                    ->where('passers.id_local', '=', $request->id_local)
                    ->where('examens.seance_examen', '=', 'S1')
                    ->first();
    
    
                    $module2 = module::select('modules.intitule_module')
                    ->join('examens', 'modules.code_module', '=', 'examens.code_module')
                    ->join('passers', 'examens.id_examen', '=', 'passers.id_examen')
                    ->where('examens.demi_journee_examen', '=', $request->demi_journee)
                    ->where('examens.date_examen', '=', $request->date)
                    ->where('passers.id_local', '=', $request->id_local)
                    ->where('examens.seance_examen', '=', 'S2')
                    ->first();
                
    
                $etudiantsPS1 = etudiant::select('etudiants.nom_etudiant', 'etudiants.prenom_etudiant', 'etudiants.CNE', 'etudiants.codeApogee', 'passers.num_exam')
                    ->join('passers', 'etudiants.codeApogee', '=', 'passers.codeApogee')
                    ->join('examens', 'examens.id_examen', '=', 'passers.id_examen')
                    ->where('examens.demi_journee_examen', '=', $request->demi_journee)
                    ->where('examens.date_examen', '=', $request->date)
                    ->where('examens.seance_examen', '=', 'S1')
                    ->where('passers.id_local', '=', $request->id_local)
                    ->where('passers.isPresent', '=', true)
                    ->get();
    
                $etudiantsAS1 = etudiant::select('etudiants.nom_etudiant', 'etudiants.prenom_etudiant', 'etudiants.CNE', 'etudiants.codeApogee', 'passers.num_exam')
                    ->join('passers', 'etudiants.codeApogee', '=', 'passers.codeApogee')
                    ->join('examens', 'examens.id_examen', '=', 'passers.id_examen')
                    ->where('examens.demi_journee_examen', '=', $request->demi_journee)
                    ->where('examens.date_examen', '=', $request->date)
                    ->where('examens.seance_examen', '=', 'S1')
                    ->where('passers.id_local', '=', $request->id_local)
                    ->where('passers.isPresent', '=', false)
                    ->get();
    
                $etudiantsPS2 = etudiant::select('etudiants.nom_etudiant', 'etudiants.prenom_etudiant', 'etudiants.CNE', 'etudiants.codeApogee', 'passers.num_exam')
                    ->join('passers', 'etudiants.codeApogee', '=', 'passers.codeApogee')
                    ->join('examens', 'examens.id_examen', '=', 'passers.id_examen')
                    ->where('examens.demi_journee_examen', '=', $request->demi_journee)
                    ->where('examens.date_examen', '=', $request->date)
                    ->where('examens.seance_examen', '=', 'S2')
                    ->where('passers.id_local', '=', $request->id_local)
                    ->where('passers.isPresent', '=', true)
                    ->get();
    
                $etudiantsAS2 = etudiant::select('etudiants.nom_etudiant', 'etudiants.prenom_etudiant', 'etudiants.CNE', 'etudiants.codeApogee', 'passers.num_exam')
                    ->join('passers', 'etudiants.codeApogee', '=', 'passers.codeApogee')
                    ->join('examens', 'examens.id_examen', '=', 'passers.id_examen')
                    ->where('examens.demi_journee_examen', '=', $request->demi_journee)
                    ->where('examens.date_examen', '=', $request->date)
                    ->where('examens.seance_examen', '=', 'S2')
                    ->where('passers.id_local', '=', $request->id_local)
                    ->where('passers.isPresent', '=', false)
                    ->get();
    
                $session = session::select('sessions.nom_session', 'sessions.type_session', 'sessions.Annee_universitaire', 'examens.date_examen', 'examens.demi_journee_examen', 'examens.seance_examen', 'examens.id_pv', 'modules.intitule_module')
                    ->distinct()
                    ->join('examens', 'examens.id_session', '=', 'sessions.id_session')
                    ->join('passers', 'examens.id_examen', '=', 'passers.id_examen')
                    ->join('modules', 'examens.code_module', '=', 'modules.code_module')
                    ->where('examens.demi_journee_examen', '=', $request->demi_journee)
                    ->where('examens.date_examen', '=', $request->date)
                    ->where('passers.id_local', '=', $request->id_local)
                    ->get();
    
                $surveillants = surveillant::select('surveillants.nomComplet_s', 'surveillants.id_surveillant', 'surveillants.id_departement')
                    ->join('signers', 'signers.id_surveillant', '=', 'surveillants.id_surveillant')
                    ->join('pvs', 'signers.id_pv', '=', 'pvs.id_pv')
                    ->where('pvs.id_pv', '=', $session->first()->id_pv ?? null)
                    ->where('signers.signer', '=', true)
                    ->get();
    
                $rapportCodes = array_merge(
                    $etudiantsPS1->pluck('codeApogee')->toArray(),
                    $etudiantsAS1->pluck('codeApogee')->toArray(),
                    $etudiantsPS2->pluck('codeApogee')->toArray(),
                    $etudiantsAS2->pluck('codeApogee')->toArray()
                );
    
                $rapport = Rapport::select('rapports.codeApogee', 'rapports.titre_rapport', 'rapports.contenu', 'etudiants.nom_etudiant')
                    ->join('etudiants', 'etudiants.codeApogee', '=', 'rapports.codeApogee')
                    ->whereIn('rapports.codeApogee', $rapportCodes)
                    ->where('rapports.id_pv', '=', $session->first()->id_pv ?? null)
                    ->get();
    
                return response()->json([
                    'status_code' => 201,
                    'examen1' =>$examen1->isEmpty() ? null : $examen1,
                    'module1' => $module1 ? $module1->intitule_module : null,
                    'module2' => $module2 ? $module2->intitule_module : null,
                    'surveillants' => $surveillants->isEmpty() ? null : $surveillants,
                    'etudiantsPS1' => $etudiantsPS1->isEmpty() ? null : $etudiantsPS1,
                    'etudiantsAS1' => $etudiantsAS1->isEmpty() ? null : $etudiantsAS1,
                    'etudiantsPS2' => $etudiantsPS2->isEmpty() ? null : $etudiantsPS2,
                    'etudiantsAS2' => $etudiantsAS2->isEmpty() ? null : $etudiantsAS2,
                    'session' => $session->isEmpty() ? null : $session,
                    'rapport' => $rapport->isEmpty() ? null : $rapport,
                ]);
            } else {
                return response()->json([
                    'status_code' => 404,
                    'message' => 'Local not found'
                ]);
            }
        } catch (Exception $exception) {
            return response()->json([
                'status_code' => 500,
                'message' => $exception->getMessage()
            ]);
        }
    }
    


public function getPdf(Request $request)  {
    try {
        
       $pv = pv::select('pvs.file_path')
       ->distinct()
       ->join('examens', 'pvs.id_pv', '=', 'examens.id_pv')
       ->where('examens.id_session', '=', $request->id_session)
       ->get();
       foreach ($pv as $key => $value) {
           $p=explode('/',$value); 
            $pdf[$key]=$p[1]; 
       }
       return response()->json([
        'status_code' => 201,
        'pv' => $pv->isEmpty() ? null : $pv,
    ]);
    } catch (Exception $exception) {
        return response()->json([
            'status_code' => 500,
            'message' => $exception->getMessage()
        ]);
    }
}


public function show($filename)
{
    $path = storage_path('app/pdfs/' . $filename);

    if (!Storage::disk('local')->exists("pdfs/$filename")) {
        return response()->json(['error' => 'File not found'], 404);
    }

    $headers = [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="' . $filename . '"', // or 'attachment' to force download
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization'
    ];

    return response()->file($path, $headers);
}



        
}