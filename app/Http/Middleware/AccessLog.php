<?php

namespace App\Http\Middleware;

use Closure;
use DateTime;
use Illuminate\Support\Facades\DB;

class AccessLog
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
        $response = $next($request);

        DB::table('access_logs')->insert([
            'path'       => $request->path(),
            'ip'         => $request->getClientIp(),
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);

        return $response;
    }
}
