@extends('guest-layout')

@section('task')
<div class="container">
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-12 col-md-12 text-center">
            <h2>Úloha: {{$task->task_id}}</h2>
            <p>{!! e($task->task) !!}</p>
            @if($task->task_image !== '')
                <img src="{{ asset('img/images/' . $task->task_image) }}" class="img-fluid" alt="Task image">
            @endif
            <h2>Riešenie</h2>
            <p>{!! e($task->solution) !!}</p>
        </div>
    </div>
</div>
@endsection