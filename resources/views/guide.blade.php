@extends('guest-layout')

@section('guide')
<div class="container">
    <h1>{{ __('messages.guide') }}</h1>
    <h5 class="guide-header">{{ __('messages.guide-h5') }}</h5>
    <p class="guide-text">{{ __('messages.guide-text') }}</p>

    <div class="export-buttons">
        <a href="{{ route('export.csv') }}" class="btn btn-info">{{ __('messages.csv-button') }}</a>
        <a href="{{ route('export.pdf') }}" class="btn btn-info">{{ __('messages.pdf-button') }}</a>
    </div>
</div>
@endsection