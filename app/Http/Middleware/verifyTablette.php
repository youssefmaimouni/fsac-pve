<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Tablette;

/**
 * Middleware to verify the UUID of a tablet.
 *
 * This middleware checks if the UUID provided in the request headers exists in the tablettes database.
 * It is used to authenticate requests from tablets without requiring traditional login credentials,
 * ensuring that the request is from a registered tablet device.
 */
class VerifyTabletUUID
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * This method retrieves the 'X-Tablet-UUID' header from the request. It checks if this UUID exists
     * in the 'tablettes' table. If the UUID is not found, it returns an unauthorized response.
     * If the UUID is valid, it passes the request to the next middleware.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return $next($request);
        }
        // Retrieve the UUID from the request header
        $uuid = $request->header('X-Tablet-UUID');

        // Check if the UUID is present and valid
        if (!$uuid || !Tablette::where('adresse_mac', $uuid)->exists()) {
            // Return a 401 Unauthorized response if the UUID is not registered
            return response()->json(['message' => 'Unauthorized - Tablet  not registered'], 401);
        }

        // If the UUID is verified, pass the request to the next middleware
        return $next($request);
    }
}