<?php

namespace App\Services\User;

use Throwable;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\InternalServerErrorException;

class UserService implements UserServiceInterface
{
  public function createUser($data): User
  {
    $user = (object)[];
    DB::beginTransaction();
    try {
      $user = User::create([
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'password' => Hash::make($data['password']),
        'email' => $data['email'],
        'role' => 'student'
      ]);
    } catch (Throwable $e) {
      DB::rollBack();
      throw new InternalServerErrorException();
    }
    DB::commit();
    return $user;
  }
}
