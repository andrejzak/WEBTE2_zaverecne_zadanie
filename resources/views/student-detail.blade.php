@extends('guest-layout')

@section('teacher')
<div class="container">
    <h1>{{ __('messages.teacher') }}</h1>
    <h2>{{ __('messages.detail') }}</h2>
    <p>ID: {{ $student->id }}</p>
    <p>{{ __('messages.name') }}: {{ $student->first_name }}</p>
    <p>{{ __('messages.surname') }}: {{ $student->last_name }}</p>
    <p>Email: {{ $student->email }}</p>
    
    <h2>{{ __('messages.accepted-tasks') }}</h2>
    @if($tasks->isEmpty())
        <p>{{ __('messages.accepted-msg') }}</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('messages.task-id') }}</th>
                <th>{{ __('messages.max-score') }}</th>
                <th>{{ __('messages.earned') }}</th>
                <th>{{ __('messages.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr class="{{ $task->points_given === null ? 'tr-unsubmitted' : 'tr-submitted' }}">
                    <td>{{ $task->task_id }}</td>
                    <td>{{ $task->points_max }}</td>
                    <td>{{ $task->points_given ?? __('messages.not-submit')}}</td>
                    <td><a class="btn btn-primary" href="{{ route('showTaskDetail', $task->id) }}">Detail</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
