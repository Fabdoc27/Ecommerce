<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use App\Helper\ResponseHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenAuthenticationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');
        $result = JWTToken::verifyToken($token);

        if ($result == 'Unauthorized') {
            return ResponseHelper::Output('unauthorized', null, 401);
        } else {

            $request->headers->set('email', $result->userEmail);
            $request->headers->set('id', $result->userId);

            return $next($request);
        }
    }
}
