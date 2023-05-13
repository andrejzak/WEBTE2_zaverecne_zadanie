<?php

namespace App\Http\Requests;

use App\Models\Enums\Role;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegistrationRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'first_name' => 'required|string|max:55',
      'last_name' => 'required|string|max:55',
      'email' => 'required|email|unique:users,email|max:100',
      'password' => [
        'required',
        'confirmed',
        Password::min(8)
          ->symbols()
          ->mixedCase()
          ->numbers(),
        'max:100',
      ],
      "role" => [
        "required",
        new Enum(Role::class)
      ]
    ];
  }

  protected function failedValidation(Validator $validator)
  {
    $errors = $validator->errors();
    throw new HttpResponseException(response()->json([
      'message' => '',
      'errors' => $errors,
    ], Response::HTTP_BAD_REQUEST));
  }
}
