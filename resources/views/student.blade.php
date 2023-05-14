@extends('guest-layout')

@section('student')
<div class="container">
    <h1>{{ __('messages.student') }}</h1>
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-12 col-md-12 text-center">
            <button type="button" class="btn btn-info">{{ __('messages.student-btn-1') }}</button>
        </div>

        <div class="col-lg-12 col-md-12 text-center">
            <button type="button" class="btn btn-info">{{ __('messages.student-btn-2') }}</button>
        </div>
    </div>
</div>
@endsection


