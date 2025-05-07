<?php

namespace Meri\NameApp\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Autenticador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        // Ao chamar o método Auth::check ela verifica no guard configurado se há algum usuário presente. O guard padrão é session que armazena o usuário em sessão.
        if (!Auth::check()) {
            throw new AuthenticationException();
        };

        return $response;
    }
}
