<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;

class BasicAuthMiddleware extends AuthenticateWithBasicAuth {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = null, $field = null) {
		$this->auth->guard($guard)->basic($field ?? "name");
		return $next($request);
	}
}
