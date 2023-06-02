<?php

namespace App\Http\Middleware;

use App\Models\Access;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $bearer = $request->header('Authorization');
        if ($bearer) {
            $token = explode(" ", $bearer)[1];
            $dataAccess = Access::where('id', $token)->first();
            if ($dataAccess) return $next($request);
        }
        return response()->json([
            "status" => "false",
            "code" => 401,
            "message" => "Unauthorized"
        ], 401);
    }
}
