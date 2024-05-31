<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
class activityController extends Controller

  
{
    
        /**
     * @OA\Get(
     *     path="/api/logs",
     *     tags={"Activity"},
     *     summary="Get all admins for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="activity",
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
        public function index()
        {
            $activities = Activity::all();
            return response()->json($activities);
        }
   
}
