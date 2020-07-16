<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Exception;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  /**
   * @param Request $request
   * @return JsonResponse
   */
  public function login(Request $request)
  {
    $credentials = $request->only('email', 'password');
    if ($token = $this->guard()->attempt($credentials)) {
      return response()
        ->json(['status' => 'success'], 200)
        ->header('Authorization', $token);
    }
    return response()
      ->json(['error' => 'login_error'], 401);
  }

  /**
   * @return JsonResponse
   */
  public function logout()
  {
    $this->guard()->logout();
    return response()
      ->json(['status' => 'success'], 200);
  }

  /**
   * @return JsonResponse
   */
  public function user()
  {
    $user = User::find(Auth::user()->id);
    return response()
      ->json([
        'status' => 'success',
        'data' => $user
      ]);
  }

  /**
   * @return JsonResponse
   */
  public function refresh()
  {
    try {
      /** @noinspection PhpPossiblePolymorphicInvocationInspection */
      if ($token = $this->guard()->refresh()) {
        return response()
          ->json(['status' => 'success'], 200)
          ->header('Authorization', $token);
      }
    } catch (Exception $e) {
    }

    return response()
      ->json(['error' => 'refresh_token_error'], 401);
  }

  /**
   * @return Guard|StatefulGuard
   */
  private function guard()
  {
    return Auth::guard();
  }
}
