@extends('guest-layout')

@section('teacher')
<div class="container">
    <h1>{{ __('messages.teacher') }}</h1> 
    @foreach ($files as $file)
        <div>
            <form action="{{ route('addFile') }}" method="post">
                @csrf
                <input class="input-group-text" type="hidden" name="file" value="{{ $file }}">
                <div class="input-group mb-3">
                    <span class="input-group-text">{{ $file }}</span>
                    <span class="input-group-text" for="start_date">Dátum začiatku:</span>
                    <input class="form-control" type="date" id="start_date" name="start_date">
                    <span class="input-group-text" for="points">Počet bodov:</span>
                    <input class="form-control" type="number" id="points" value="12" name="points">
                    <button class="btn btn-primary" type="submit">Zverejniť príklady</button>
                </div>
            </form>
        </div>
    @endforeach
</div>
@endsection