@extends('guest-layout')

@section('registration')
<div class="container">
  <h1 class="text-center">Registrácia</h1>
  <form id="registration-form" method="POST" action={{ route('registration') }} class="my-form row g-3">
    @csrf
    <div class="col-md-6">
      <label for="firstName" class="form-label">Meno</label>
      <input id="firstName" name="first_name" type="text" class="form-control" value={{ old('first_name') }}>
      <span class="text-danger">@error("first_name") {{ $message }} @enderror</span>    
    </div>
    <div class="col-md-6">
      <label for="lastName" class="form-label">Priezvisko</label>
      <input id="lastName" name="last_name" type="text" class="form-control" value={{ old('last_name') }}>
      <span class="text-danger">@error("last_name") {{ $message }} @enderror</span>    
    </div>
    <div class="col-md-6">
      <label for="email" class="form-label ">Email</label>
      <input id="email" name="email" type="text" class="form-control" value={{ old('email') }}>
      <span class="text-danger">@error("email") {{ $message }} @enderror</span>    
    </div>
    <div class="col-md-6">
      <label for="password" class="form-label">Heslo</label>
      <input id="password" name="password" type="password" class="form-control">
      <span class="text-danger">@error("password") {{ $message }} @enderror</span>    
    </div>
    <div class="col-md-6">
      <label for="passwordConfirmation" class="form-label">Potvrdenie hesla</label>
      <input id="passwordConfirmation" name="password_confirmation" type="password" class="form-control">
      <span class="text-danger">@error("password_confirmation") {{ $message }} @enderror</span>    
    </div>
    <button type="submit" class="btn btn-primary col-md-12">Registrovať sa</button>
  </form>   
</div>
@endsection