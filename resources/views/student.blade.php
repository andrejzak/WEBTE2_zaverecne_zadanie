@extends('guest-layout')

@section('student')
<div class="container">
    <h1>{{ __('messages.student') }}</h1>
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-12 col-md-12 text-center">
            <button type="button" id="showTasksButton" class="btn btn-info">Aktuálne datasety na preriešenie</button>
        </div>
        @if(isset($taskSets))
            <form action="/generateRandomTask" method="POST">
                @csrf
                <div class="col-lg-12 col-md-12 text-center" id="tasksSection" style="display:none">
                        @foreach ($taskSets as $taskSet)
                            <div class="form-check bg-light">
                                <input type="checkbox" class="form-check-input" name="selectedFiles[]" value="{{ $taskSet->id }}" id="file-{{$taskSet->id}}">
                                <label for="file-{{$taskSet->id}}" class="form-check-label">{{$taskSet->file_path}}</label>
                            </div>
                        @endforeach
                        <button class="btn btn-info" type="submit" value="Vygenerovať príklad">Vygenerovať príklad</button>   
                </div>
            </form>
        @endif 

        @if(session('task') && session('solution'))
            <div class="col-lg-12 col-md-12 text-center">
                <h2>Úloha: {{session('taskId')}}</h2>
                <p>{!! e(session('task')) !!}</p>
                @if(session('image') !== '')
                    <img src="{{ asset('img/images/' . session('image')) }}" class="img-fluid" alt="Task image">
                @endif
                <h2>Riešenie</h2>
                <p>{!! e(session('solution')) !!}</p>
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


