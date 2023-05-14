@extends('guest-layout')

@section('login')
<div class="container">
  <h1 class="text-center">Prihlásenie</h1>
  <form id="form" class="my-form row g-3" method="post" action="#">
    @csrf
    <div class="col-md-12 form-group">
      <label for="lastName" class="form-label">Email</label>
      <input type="text" name="email" class="form-control" required>
    </div>
    <div class="col-md-12 form-group">
      <label for="birthDay" class="form-label">Heslo</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-info col-md-12">Prihlásiť sa</button>
  </form>    
</div>
@endsection