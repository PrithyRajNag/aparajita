@extends('layouts.master')
@section('content')
    <!-- Start Appointment Patient Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            @if(session('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {{ session('success') }}
                </div>
            @endif

            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Appointment Patient</span>
                    @if(checkUserRole('patient.appointment.store'))
                        <a href="{{route('patient.appointment.create')}}" class="btn btn-light"><i
                                class="fas fa-plus-circle"></i>&nbsp; ADD</a>
                    @endif
                </h4>
                <div class="card-body f-14">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Patient</th>
                                <th>Doctor</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
{{--                                <th>Phone</th>--}}
                                @if(checkUserRole('action.patient.appointment'))
                                    <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
{{--                                                            @dd($item->doctors->doctorInfos->fees)--}}
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    {{--                                    <td>{{ ucwords($item->patients->full_name) }}</td>--}}
                                    {{--                                    <td>{{  ucwords($item->doctors->full_name) }}</td>--}}
                                    <td>
                                        <a href="{{route('patient.show', $item->patients->id)}}" type="button"
                                           class="text-info">{{ ucwords($item->patients->full_name) }}</a>
                                    </td>
                                    <td>
                                        <a href="{{route('doctor.show', $item->doctors->id)}}" type="button"
                                           class="text-info">{{  ucwords($item->doctors->full_name) }}</a>
                                    </td>
{{--                                    <td>{{ ucwords($item->doctors->doctorInfos->fees) }}</td>--}}
                                    <td>{{ normalDateFormat($item->date) }}</td>
                                    <td>{{ normalTimeFormat($item->start_time) }}</td>
                                    <td>{{ normalTimeFormat($item->end_time) }}</td>
{{--                                    <td>{{ $item->patients->phone_number }}</td>--}}
                                    @if(checkUserRole('action.patient.appointment'))
                                        <td>
                                            @if(checkUserRole('patient.appointment.update'))
                                                <a href="{{route('patient.appointment.edit', $item->id)}}"
                                                   class="btn btn-primary f-12"><i class="fas fa-edit"></i>&nbsp;
                                                    Edit</a>
                                            @endif
                                            @if(checkUserRole('patient.appointment.destroy'))
                                                <form id="delete-form-{{ $loop->index }}"
                                                      action="{{ route('patient.appointment.destroy', $item->id) }}"
                                                      method="post"
                                                      class="form-horizontal d-inline">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <div class="btn-group">
                                                        <button onclick="deleteData({{ $loop->index }})" type="button"
                                                                class="btn btn-danger waves-effect waves-light btn-sm align-items-center">
                                                            <i class="fas fa-trash"></i>&nbsp; Delete
                                                        </button>
                                                    </div>
                                                </form>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Appointment Patient Model -->

    <!-- Start New Appointment Patient Model -->
    {{--@include('patient.appointment.create')--}}
    <!-- End New Appointment Patient Model -->

    <!-- Start Edit Appointment Patient Model -->
    {{--@include('patient.appointment.edit')--}}
    <!-- End Edit Appointment Patient Model -->
@endsection
@push('customScripts')
    <script>
        // Script(For Delete)
        function deleteData(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085D6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result)=>{
                if(result.value){
                document.getElementById('delete-form-' + id).submit();
                setTimeout(1000);
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
        }
    </script>
@endpush
