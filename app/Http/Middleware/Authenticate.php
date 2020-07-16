<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
  /**
   * @param Request $request
   * @param Closure $next
   * @param mixed ...$guards
   * @return JsonResponse|mixed
   */
  public function handle($request, Closure $next, ...$guards)
  {
    if ($this->authenticate($request, $guards) === 'authentication_error') {
      return response()->json(['error' => 'Unauthorized']);
    }
    return $next($request);
  }

  /**
   * @param Request $request
   * @param array $guards
   * @return string|void
   */
  protected function authenticate($request, array $guards)
  {
    if (empty($guards)) {
      $guards = [null];
    }
    foreach ($guards as $guard) {
      if ($this->auth->guard($guard)->check()) {
        $this->auth->shouldUse($guard);

        return 'ok';
      }
    }
    return 'authentication_error';
  }
}
