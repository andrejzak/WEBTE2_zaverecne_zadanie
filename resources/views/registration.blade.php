@extends('guest-layout')

@section('registration')
<div class="container">
  <h1 class="text-center">{{ __('messages.registration') }}</h1>
  <form id="form" class="my-form row g-3">
    @csrf
    <div class="col-md-12 form-group">
      <label for="firstName" class="form-label">{{ __('messages.name') }}</label>
      <input id="rFirstName" type="text" class="form-control" required>
    </div>
    <div class="col-md-12 form-group">
      <label for="lastName" class="form-label">{{ __('messages.surname') }}</label>
      <input id="rLastName" type="text" class="form-control" required>
    </div>
    <div class="col-md-12 form-group">
      <label for="rEmail" class="form-label ">Email</label>
      <input id="rEmail" type="text" class="form-control" required>
    </div>
    <div class="col-md-12 form-group">
      <label for="rPassword" class="form-label">{{ __('messages.password') }}</label>
      <input id="rPassword" type="password" class="form-control" required>
    </div>
    <div class="col-md-12 form-group">
      <label for="rPasswordConfirmation" class="form-label">{{ __('messages.confirm') }}</label>
      <input id="rPasswordConfirmation" type="password" class="form-control" required>
    </div>
    <button type="button" onclick="submitForm()" class="btn btn-info col-md-12">{{ __('messages.signup') }}</button>
  </form>   
</div>
<script src="{{ asset('js/registration.js') }}"></script>
@endsection