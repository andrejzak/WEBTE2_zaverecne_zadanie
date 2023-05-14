@extends('guest-layout')

@section('registration')
<div class="container">
  <h1 class="text-center">{{ __('messages.registration') }}</h1>
  <form id="form" method="POST" action={{ route('registration') }} class="my-form row g-3">
    @csrf
    <div class="col-md-12 form-group">
      <label for="firstName" class="form-label">{{ __('messages.name') }}</label>
      <input id="firstName" name="first_name" type="text" class="form-control" value={{ old('first_name') }}>
      <span class="text-danger">@error("first_name") {{ $message }} @enderror</span>    
    </div>
    <div class="col-md-12 form-group">
      <label for="lastName" class="form-label">{{ __('messages.surname') }}</label>
      <input id="lastName" name="last_name" type="text" class="form-control" value={{ old('last_name') }}>
      <span class="text-danger">@error("last_name") {{ $message }} @enderror</span>    
    </div>
    <div class="col-md-12 form-group">
      <label for="rEmail" class="form-label ">Email</label>
      <input id="email" name="email" type="text" class="form-control" value={{ old('email') }}>
      <span class="text-danger">@error("email") {{ $message }} @enderror</span>    
    </div>
    <div class="col-md-12 form-group">
      <label for="rPassword" class="form-label">{{ __('messages.password') }}</label>
      <input id="password" name="password" type="password" class="form-control">
      <span class="text-danger">@error("password") {{ $message }} @enderror</span>   
    </div>
    <div class="col-md-12 form-group">
      <label for="rPasswordConfirmation" class="form-label">{{ __('messages.confirm') }}</label>
      <input id="passwordConfirmation" name="password_confirmation" type="password" class="form-control">
      <span class="text-danger">@error("password_confirmation") {{ $message }} @enderror</span>   
    </div>
    <button type="submit" class="btn btn-info col-md-12">{{ __('messages.signup') }}</button>
  </form>   
</div>
@endsection