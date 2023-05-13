@extends('guest-layout')

@section('registration')
<div class="container">
  <h1 class="text-center">Registrácia</h1>
  <form id="form" class="my-form row g-3" method="post" action="#">
    <div class="col-md-6">
      <label for="firstName" class="form-label">Meno</label>
      <input type="text" name="first_name" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label for="lastName" class="form-label">Priezvisko</label>
      <input type="text" name="last_name" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label for="lastName" class="form-label ">Email</label>
      <input type="text" name="email" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label for="birthDay" class="form-label">Heslo</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label for="birthPlace" class="form-label">Potvrdenie hesla</label>
      <input type="password" name="password_confirmation" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary col-md-12">Registrovať sa</button>
  </form>   
</div>
@endsection