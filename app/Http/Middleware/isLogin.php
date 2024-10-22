<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Symfony\Component\HttpFoundation\Response;

class isLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (FacadesAuth::guard("inspector")->check()) {
            return match (FacadesAuth::guard("inspector")->user()->lvl) {
                "admin" => redirect("/admin/control/panel/dashboard"),
                "petugas" => redirect("/petugas/control/panel/dashboard"),
            };
        } else if (FacadesAuth::guard("member")->check()) {
            return redirect("/home");
        } else {
            return redirect("/login");
        }
    }
}
