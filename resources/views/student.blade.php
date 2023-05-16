@extends('guest-layout')

@section('student')
<div class="container">
    <h1>{{ __('messages.student') }}</h1>
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-12 col-md-12 text-center">
            <a href="{{ route('generateRandomTask') }}" type="button" class="btn btn-info">{{ __('messages.student-btn-1') }}</a>
        </div>

        <div class="col-lg-12 col-md-12 text-center">
            <button type="button" id="showTasksButton" class="btn btn-info">{{ __('messages.student-btn-2') }}</button>
        </div>


        @if(isset($task) && isset($solution))
            <div class="col-lg-12 col-md-12 text-center">
                <h2>Úloha: {{$taskId}}</h2>
                <p>{!! e($task) !!}</p>
                @if($image !== '')
                    <img src="{{ asset('img/images/' . $image) }}" class="img-fluid" alt="Task image">
                @endif
                <h2>Riešenie</h2>
                <p>{!! e($solution) !!}</p>
            </div>
        @endif
    </div>
</div>
<script>
    document.getElementById("showTasksButton").addEventListener("click", function() {
        document.getElementById("tasksSection").style.display = "block";
    });
</script>
@endsection


