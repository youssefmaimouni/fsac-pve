<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
class activityController extends Controller

  
{
    
        
        public function index()
        {
            $activities = Activity::all();
            return response()->json($activities);
        }
   
}
