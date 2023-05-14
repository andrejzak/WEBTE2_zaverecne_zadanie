<?php

namespace App\Http\Controllers;

use App\Models\Enums\Role;
use App\Traits\HttpResponses;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Dotenv\Exception\ValidationException;
use App\Http\Requests\RegistrationRequest;
use App\Services\User\UserServiceInterface;
use App\Exceptions\InternalServerErrorException;

class AuthController extends Controller
{
  use HttpResponses;

  private UserServiceInterface $userService;

  public function __construct(UserServiceInterface $userService)
  {
    $this->userService = $userService;
  }

  /**
   * Register new user if request data are valid.
   *
   * @param  RegistrationRequest  $request
   * @return Illuminate\Http\JsonResponse
   */
  public function registration(RegistrationRequest $request)
  {
    $user = (object)[];
    $data = $request->validated();
    try {
      $user = $this->userService->createUser($data);
    } catch (InternalServerErrorException $e) {
      return redirect()->back();
    }
    Session::put('loggedin', true);
    return redirect()->route('student')->with('user', $user);
  }

  /**
   * Login user if credentials are valid.
   *
   * @param  LoginRequest  $request
   * @return Illuminate\Http\JsonResponse
   */
  public function login(LoginRequest $request)
  {
    $credentials = $request->validated();
    if (!Auth::attempt($credentials)) {
      $language = session('applocale', 'en');
      App::setLocale($language);
      return redirect()->back()->withErrors(['email' => trans("messages.invalid-credentials")]);
    }
    $user = Auth::user();
    $user->tokens()->delete();
    $token = $user->createToken('main')->plainTextToken;
    Session::put('loggedin', true);
    // dd(Session::get('loggedin'));
    if ($user->role === Role::Teacher) {
      return redirect()->route('teacher')->with('user', $user);
    } else {
      return redirect()->route('student')->with('user', $user);
    }
  }

  /**
   * Logout user from system.
   *
   * @return Illuminate\Http\JsonResponse
   */
  public function logout()
  {
    Auth::user()->currentAccessToken()->delete();
    return $this->success([], 200);
  }

  /**
   * Get authenticate user.
   *
   * @return Illuminate\Http\JsonResponse
   */
  public function authUser()
  {
    return $this->success(Auth::user(), 200);
  }
}
