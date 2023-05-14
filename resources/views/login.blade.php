@extends('guest-layout')

@section('login')
<div class="container">
  <h1 class="text-center">{{ __('messages.login') }}</h1>
  <form id="form" class="my-form row g-3" method="POST" action={{ route('login-form') }}>
    @csrf
    <div class="col-md-12 form-group">
      <label for="email" class="form-label ">Email</label>
      <input id="email" name="email" type="text" class="form-control" value={{ old('email') }}>
      <span class="text-danger">@error("email") {{ $message }} @enderror</span>    
    </div>
    <div class="col-md-12 form-group">
      <label for="password" class="form-label">{{ __('messages.password') }}</label>
      <input id="password" type="password" name="password" class="form-control">
      <span class="text-danger">@error("password") {{ $message }} @enderror</span>    
    </div>
    <button type="submit" class="btn btn-info col-md-12">{{ __('messages.signin') }}</button>
  </form>    
</div>
@endsection