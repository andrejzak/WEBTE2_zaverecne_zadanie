@extends('guest-layout')

@section('main')
<div class="container">
    <h1>{{ __('messages.welcome') }}</h1>
    <img src="{{ asset('img/welcome-gif.gif') }}" alt="description of myimage" class="wlm-img" width="250px">
</div>
@endsection