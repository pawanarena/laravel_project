<?php

namespace App\Http\Middleware;

use Closure;

class AccessApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $api_keys = array('2S7rhsaq9X1cnfkMCPHX64YsWYyfe1he');

        if ($request->header('Authorization')) {
            $api_key = $request->header('Authorization');

            // check token
            if (in_array($api_key, $api_keys)) {
                return $next($request);
            } else {
                return response()->json([
                    'results' => 'API key is not valid',
                ]);
            }
        }

        return response()->json([
            'results' => 'Authorization failed',
        ]);
    }
}