@extends('guest-layout')

@section('teacher')
<div class="container">
    <h1>{{ __('messages.teacher') }}</h1>
    @foreach ($files as $file)
        <div>
            <form action="{{ route('addFile') }}" method="post">
                @csrf
                <input class="input-group-text" type="hidden" name="file" value="{{ $file }}">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text">{{ $file }}</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" for="start_date">{{ __('messages.start-date') }}</span>
                            <input class="form-control" type="date" id="start_date" name="start_date">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" for="points">{{ __('messages.points') }}</span>
                            <input class="form-control" type="number" id="points" value="12" name="points">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <button class="btn btn-secondary mb-3" type="submit">{{ __('messages.post-task') }}</button>
                    </div>
                </div>
                    
            </form>
        </div>
    @endforeach
</div>
@endsection