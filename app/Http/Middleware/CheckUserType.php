<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$types): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if (in_array($user->id_rol, $types)) {
            return $next($request);
        }

        return redirect('/error403')->with([
            'error-code'   => 403,
            'error-message'   => 'Lo sentimos, no tienes permisos para acceder a esta página.',
            'error-details1'  => 'Es posible que necesites iniciar sesión o que tu cuenta no tenga los privilegios necesarios para ver este contenido.',
            'error-details2'  => 'Si crees que esto es un error, por favor contacta al administrador del sistema.'
        ]);
    }
}