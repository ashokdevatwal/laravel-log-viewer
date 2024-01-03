<?php

namespace Rap2hpoutre\LaravelLogViewer;

use Closure;

use Config;

class LogViewerBasicAuthMiddleware
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
        $username = Config::get('logviewer.username');
        $password = Config::get('logviewer.password');

        $givenUsername = $request->getUser();
        $givenPassword = $request->getPassword();

        if ($givenUsername !== $username || $givenPassword !== $password) {
            return response('Unauthorized.', 401, ['WWW-Authenticate' => 'Basic']);
        }

        return $next($request);
    }
}