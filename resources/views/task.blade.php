@extends('guest-layout')

@section('task')
<div class="container">
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-12 col-md-12 text-center">
            <h2>{{ __('messages.task') }}: {{$task->task_id}}</h2>
            <p>{!! e($task->task) !!}</p>
            @if($task->task_image !== '')
                <img src="{{ asset('img/images/' . $task->task_image) }}" class="img-fluid rounded" alt="Task image">
            @endif
            <h2>{{ __('messages.solution') }}</h2>
            @if($task->student_solution == null)
                <p>Riešenie úlohy zatiaľ nebolo odovzdané</p>
                <button id="displayFormBtn" class="btn btn-primary">Vložiť riešenie</button>
                <div class="row" id="solutionForm" style="display:none">
                    <div class="col-lg-12 col-md-12 text-center">
                        <form class="form-floating" method="post" action="{{ route('submitSolution', $task->id) }}">
                            @csrf
                            <textarea class="form-control" id="solutionInput" name="solution" required style="height: 100px" ></textarea>
                            <label for="solutionInput">Vaše riešenie</label>
                            <button type="submit" class="btn btn-primary">Odoslať riešenie</button>
                        </form>
                    </div>
                </div>
            @else
                <p>Odovzdané riešenie</p>
                <p>{!! e($task->student_solution) !!}</p>
            @endif
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $("#displayFormBtn").click(function(){
        $("#solutionForm").show();
    });
});
</script>
@endsection