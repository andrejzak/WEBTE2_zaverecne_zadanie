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
                <p>{{ __('messages.not_submitted') }}</p>
                <button id="displayFormBtn" class="btn btn-info">{{ __('messages.insert_solution') }}</button>
                <button id="popoverBtn" type="button" class="btn btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-html="true">
                    {{ __('messages.how-form') }}
                </button>
                <div class="row" id="solutionForm" style="display:none">
                    <div class="col-lg-12 col-md-12 text-center">
                        <form class="form-floating" method="post" action="{{ route('submitSolution', $task->id) }}">
                            @csrf
                            <textarea class="form-control" id="solutionInput" name="solution" required style="height: 100px" ></textarea>
                            <label for="solutionInput">{{ __('messages.your_solution') }}</label>
                            <button type="submit" class="btn btn-info">{{ __('messages.submit') }}</button>
                        </form>
                    </div>
                </div>
            @else
                <p>{{ __('messages.all_submitted') }}</p>
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
    var popoverContent = `<pre><code>
&bsol;begin{equation*}
    \\dfrac{2s^2+13s}{s^3+7s^2+18s}
&bsol;end{equation*}
</code></pre>`;
    $("#popoverBtn").popover({
        content: popoverContent
    })
});
</script>
@endsection