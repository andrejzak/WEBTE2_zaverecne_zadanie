@extends('guest-layout')

@section('registration')
<div class="container">
  <h1 class="text-center">Registrácia</h1>
  <form id="form" class="my-form row g-3">
    @csrf
    <div class="col-md-6">
      <label for="firstName" class="form-label">Meno</label>
      <input id="rFirstName" type="text" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label for="lastName" class="form-label">Priezvisko</label>
      <input id="rLastName" type="text" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label for="rEmail" class="form-label ">Email</label>
      <input id="rEmail" type="text" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label for="rPassword" class="form-label">Heslo</label>
      <input id="rPassword" type="password" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label for="rPasswordConfirmation" class="form-label">Potvrdenie hesla</label>
      <input id="rPasswordConfirmation" type="password" class="form-control" required>
    </div>
    <button type="button" onclick="submitForm()" class="btn btn-primary col-md-12">Registrovať sa</button>
  </form>   
</div>
<script src="{{ asset('js/registration.js') }}"></script>
@endsection