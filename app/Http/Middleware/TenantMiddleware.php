<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TenantMiddleware
{
    /**
     * Resolve the tenant from the subdomain and switch the DB connection.
     */
    public function handle(Request $request, Closure $next)
    {
        // $tenant = $request->getHost();
        // Switch DB logic here for multi-tenancy
        
        return $next($request);
    }
}
