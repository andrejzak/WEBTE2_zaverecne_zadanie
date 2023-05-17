@extends('guest-layout')

@section('teacher')
<div class="container">
    <h1>{{ __('messages.teacher') }}</h1>
    <div class="row align-items-center justify-content-center">
        <p>ID: {{ $student->id }}</p>
        <p>{{ __('messages.name') }}: {{ $student->first_name }}</p>
        <p>{{ __('messages.surname') }}: {{ $student->last_name }}</p>
        <p>{{ __('messages.max-score') }}: {{$task->points_max}}</p>
        <p>{{ __('messages.earned') }}: {{$task->points_given ?? __('messages.not-submit')}}</p>
        <div class="col-lg-12 col-md-12 text-center">
            <h2>{{ __('messages.task') }}: {{$task->task_id}}</h2>
            <p>{!! e($task->task) !!}</p>
            @if($task->task_image !== '')
                <img src="{{ asset('img/images/' . $task->task_image) }}" class="img-fluid rounded" alt="Task image">
            @endif
            <h2>{{ __('messages.example-sol') }}</h2>
            <p>{!! e($task->solution) !!}</p>
            @if($task->student_solution == null)
                <h2>{{ __('messages.not-done') }}</h2>
            @else
                <h2>{{ __('messages.sol-by-student') }}</h2>
                <p>{!! e($task->student_solution) !!}</p>
            @endif
        </div>
    </div>
</div>
@endsection