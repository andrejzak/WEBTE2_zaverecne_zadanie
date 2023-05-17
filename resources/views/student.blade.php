@extends('guest-layout')

@section('student')
<div class="container">
    <h1>{{ __('messages.student') }}</h1>
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-12 col-md-12 text-center">
            <button type="button" id="showTasksButton" class="btn btn-info">{{ __('messages.datasets') }}</button>
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
                        <button class="btn btn-success" type="submit" value="Vygenerovať príklad">{{ __('messages.generate') }}</button>   
                </div>
            </form>
        @endif 
        <div class="col-lg-12 col-md-12 text-center">
            <a href="/tasks/accepted" class="btn btn-info">{{ __('messages.list') }}</a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (){

        let show_datasets = "{{ __('messages.datasets') }}";
        let hide_datasets = "{{ __('messages.hide') }}";

        $('#showTasksButton').click(function () {
            $('#tasksSection').toggle();
            if($('#showTasksButton').hasClass('btn-info')){
                $('#showTasksButton').html(hide_datasets);
                $('#showTasksButton').removeClass('btn-info');
                $('#showTasksButton').addClass('btn-danger');
            }
            else{
                $('#showTasksButton').html(show_datasets);
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


