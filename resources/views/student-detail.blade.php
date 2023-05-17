@extends('guest-layout')

@section('teacher')
<div class="container">
    <h1>{{ __('messages.teacher') }}</h1>
    <h2>Detail študenta</h2>
    <p>ID: {{ $student->id }}</p>
    <p>Meno: {{ $student->first_name }}</p>
    <p>Priezvisko: {{ $student->last_name }}</p>
    <p>Email: {{ $student->email }}</p>
    
    <h2>Prijaté úlohy</h2>
    @if($tasks->isEmpty())
        <p>Študent zatiaľ neprijal žiadne úlohy na preriešenie.</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>ID úlohy</th>
                <th>Maximálny počet bodov</th>
                <th>Získané body</th>
                <th>Akcia</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr class="{{ $task->points_given === null ? 'tr-unsubmitted' : 'tr-submitted' }}">
                    <td>{{ $task->task_id }}</td>
                    <td>{{ $task->points_max }}</td>
                    <td>{{ $task->points_given ?? 'Neodovzdané'}}</td>
                    <td><a class="btn btn-primary" href="{{ route('showTaskDetail', $task->id) }}">Detail</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
