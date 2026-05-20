<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TenantAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Super admin doesn't need tenant
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // Owner must have tenant
        if (!$user->tenant_id) {
            abort(403, 'Anda tidak terdaftar pada tenant manapun.');
        }

        // Check tenant is active
        $tenant = $user->tenant;
        if (!$tenant || $tenant->status !== 'active') {
            abort(403, 'Tenant Anda sedang tidak aktif.');
        }

        return $next($request);
    }
}
