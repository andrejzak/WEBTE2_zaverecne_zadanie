@extends('guest-layout')

@section('login')
<div class="container">
  <h1 class="text-center">Prihlásenie</h1>
  <form id="registration-form" method="POST" action={{ route('login') }} class="my-form row g-3">
    @csrf
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
    <button type="submit" class="btn btn-primary col-md-12">Registrovať sa</button>
  </form>    
</div>
@endsection