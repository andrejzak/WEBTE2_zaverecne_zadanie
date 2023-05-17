@extends('guest-layout')

@section('tasks-accepted')
    @if(isset($tasks))
            <div class="col-lg-12 col-md-12 text-center">
            <h1>Zoznam prijatých úloh</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID úlohy</th>
                        <th>Max. počet bodov</th>
                        <th>Počet získaných bodov</th>
                        <th>Akcia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->task_id }}</td>
                            <td>{{ $task->points_max }}</td>
                            <td>{{ $task->points_given ?? 'Body ešte neboli pridelené' }}</td>
                            <td>
                                <a href="/task/{{ $task->id}}" class="btn btn-primary">Zobraziť úlohu</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        @endif 
@endsection