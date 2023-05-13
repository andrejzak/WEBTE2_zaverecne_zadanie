<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
    $data = $request->validated();
    $user = (object)[];
    try {
      $user = $this->userService->createUser($data);
    } catch (InternalServerErrorException $e) {
      return $this->error(500);
    }
    return $this->success([
      'user' => $user->toArray(),
      'token' => $user->createToken('main')->plainTextToken
    ], 201);
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
      return $this->error(401, [
        'email' => "Nesprávny email alebo heslo"
      ]);
    }
    $user = Auth::user();
    $user->tokens()->delete();
    return $this->success([
      'user' => $user,
      'token' => $user->createToken('main')->plainTextToken
    ], 200);
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
