@extends('layouts.master')
@section('content')
    <!-- Start Doctors Time Schedule List Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            <div class="card border-success">
                @if(session('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        {{ session('success') }}
                    </div>
                @endif

                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Doctors Time Schedule List</span>
                    @if(checkUserRole('doctor.allDoctorSchedule.store'))
                        <a href="{{route('doctor.all-doctors.schedule.create')}}" id="createFormBtn"
                           class="btn btn-light"><i class="fas fa-plus-circle"></i>&nbsp; Add</a>
                    @endif
                </h4>
                <div class="card-body f-14">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter datatable-responsive table-col-bar" id="datatable-responsive">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Doctor Name</th>
                                <th>Weekday</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Patient Limit</th>
                                @if(checkUserRole('action.doctor.allDoctorSchedule'))
                                    <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                {{--                                @dd($item->doctor)--}}
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>
                                        <a href="{{route('doctor.show', $item->doctors->id)}}" type="button"
                                           class="text-info">{{  ucwords($item->doctors->full_name) }}</a>
                                    </td>
                                    <td>{{ ucwords($item->week_day)}}</td>
                                    <td>{{ normalTimeFormat($item->start_time)}}</td>
                                    <td>{{ normalTimeFormat($item->end_time)}}</td>
                                    <td>{{ ucwords($item->patient_limit)}}</td>
                                    @if(checkUserRole('action.doctor.allDoctorSchedule'))
                                        <td>
                                            @if(checkUserRole('doctor.allDoctorSchedule.update'))
                                                <a href="{{ route( 'doctor.all-doctors.schedule.edit', $item->id) }}"
                                                   class="btn btn-primary f-12"><i class="fas fa-edit"></i>&nbsp;
                                                    Edit</a>
                                            @endif
                                            @if(checkUserRole('doctor.allDoctorSchedule.destroy'))
                                                <form id="delete-form-{{ $loop->index }}"
                                                      action="{{ route('doctor.all-doctors.schedule.destroy', $item->id) }}"
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
    <!-- End Doctors Time Schedule List Model -->

    <!-- Start New Doctors Time Schedule Model -->
    {{--    @include('doctor.all_doctors_schedule.create')--}}
    <!-- End New Doctors Time Schedule Model -->

    <!-- Start Edit Doctors Time Schedule Model -->
    {{--    @include('doctor.all_doctors_schedule.edit')--}}
    <!-- End Edit Doctors Time Schedule Model -->
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
                confirmButtonColor: '#3085d6',
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

