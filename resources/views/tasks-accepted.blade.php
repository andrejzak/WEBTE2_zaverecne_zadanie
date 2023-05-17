@extends('guest-layout')

@section('tasks-accepted')
    @if(isset($tasks))
            <div class="col-lg-12 col-md-12 text-center">
            <h1>{{ __('messages.list') }}</h1>
            <div class="table-responsive">
                <table class="table table-striped">
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
                            <tr>
                                <td>{{ $task->task_id }}</td>
                                <td>{{ $task->points_max }}</td>
                                <td>{{ $task->points_given ?? __('messages.score-msg') }}</td>
                                <td>
                                    <a href="/task/{{ $task->id}}" class="btn btn-secondary">{{ __('messages.show-task') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        @endif 
@endsection