<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class LoginRequest extends FormRequest
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
      'email' => 'required|email',
      'password' => 'required'
    ];
  }

  protected function failedValidation(Validator $validator)
  {
    $language = session('applocale', 'en');
    App::setLocale($language);
    $errors = $validator->errors();
    return redirect()->back()->withErrors($errors);
  }
}
