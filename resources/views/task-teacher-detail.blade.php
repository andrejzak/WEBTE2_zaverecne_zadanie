@extends('guest-layout')

@section('teacher')
<div class="container">
    <h1>{{ __('messages.teacher') }}</h1>
    <div class="row align-items-center justify-content-center">
        <p>ID študenta: {{ $student->id }}</p>
        <p>Meno: {{ $student->first_name }}</p>
        <p>Priezvisko: {{ $student->last_name }}</p>
        <p>Maximálny počet bodov: {{$task->points_max}}</p>
        <p>Získaný počet bodov: {{$task->points_given ?? 'Neodovzdané'}}</p>
        <div class="col-lg-12 col-md-12 text-center">
            <h2>{{ __('messages.task') }}: {{$task->task_id}}</h2>
            <p>{!! e($task->task) !!}</p>
            @if($task->task_image !== '')
                <img src="{{ asset('img/images/' . $task->task_image) }}" class="img-fluid rounded" alt="Task image">
            @endif
            <h2>Vzorové riešenie</h2>
            <p>{!! e($task->solution) !!}</p>
            @if($task->student_solution == null)
                <h2>Úloha ešte nebola vypracovaná</h2>
            @else
                <h2>Riešenie odovzdané študentom</h2>
                <p>{!! e($task->student_solution) !!}</p>
            @endif
        </div>
    </div>
</div>
@endsection