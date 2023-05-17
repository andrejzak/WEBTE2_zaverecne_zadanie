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
                        <button class="btn btn-success" type="submit" value="Vygenerovať príklad">Vygenerovať príklad</button>   
                </div>
            </form>
        @endif 
        <div class="col-lg-12 col-md-12 text-center">
            <a href="/tasks/accepted" class="btn btn-info">Zoznam prijatých úloh</a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (){
        $('#showTasksButton').click(function () {
            $('#tasksSection').toggle();
            if($('#showTasksButton').hasClass('btn-info')){
                $('#showTasksButton').html("Skryť aktuálne dostupné datasety");
                $('#showTasksButton').removeClass('btn-info');
                $('#showTasksButton').addClass('btn-danger');
            }
            else{
                $('#showTasksButton').html("Aktuálne datasety na preriešenie");
                $('#showTasksButton').removeClass('btn-danger');
                $('#showTasksButton').addClass('btn-info');
            }
        });
        $('form').on('submit', function(e){
            if($('input[type=checkbox]:checked').length == 0){
                e.preventDefault();
                alert('Vyberte aspoň jeden súbor pre generovanie príkladu!');
            }
        });
    });
</script>
@endsection


