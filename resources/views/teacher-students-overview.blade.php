@extends('guest-layout')

@section('teacher')
<div class="container">
    <h1>{{ __('messages.teacher') }}</h1>
    <div class="table-responsive">
        <table class="table table-striped" id="studentsOverview">
            <thead>
                <tr>
                    <!-- <th>{{ __('messages.student_id') }}</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.surname') }}</th>
                    <th>{{ __('messages.generated_tasks') }}</th>
                    <th>{{ __('messages.submitted_tasks') }}</th>
                    <th>{{ __('messages.total_points') }}</th> -->
                    <th>>ID študenta</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.surname') }}</th>
                    <th>Vygenerované príklady celkovo</th>
                    <th>Odovzdané príklady celkovo</th>
                    <th>Body celkovo</th>
                    <th>{{ __('messages.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->first_name }}</td>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ $student->generated_tasks }}</td>
                        <td>{{ $student->submitted_tasks }}</td>
                        <td>{{ $student->total_points }}</td>
                        <td><a class="btn btn-primary" href="{{ route('showStudentDetail', $student->id) }}">Detail</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready( function () {
        $('#studentsOverview').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy','csv','excel','pdf','print'
            ],
            "columnDefs": [
                { "orderable": false, "targets": 6}, 
                { targets: [5], orderData: [5, 2] },
                { targets: [4], orderData: [4, 2] },
                { targets: [3], orderData: [3, 2] },
            ]
        });
    } );
</script>
@endsection