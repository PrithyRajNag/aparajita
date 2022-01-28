@extends('layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-12 m-3">
            @if(session('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {{ session('success') }}
                </div>
            @endif
            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Doctor List</span>
                    @if(checkUserRole('doctor.store'))
                        <a href="{{route('doctor.create')}}" id="createFormBtn" class="btn btn-light"><i
                                class="fas fa-plus-circle"></i>&nbsp; ADD</a>
                    @endif
                </h4>
                <div class="card-body f-14">
                    <div class="table-responsive" id="showDoctorList">
                        <table class="table table-striped text-canter table-col-bar">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Speciality</th>
                                <th>Type</th>
                                @if(checkUserRole('action.doctor.index'))
                                    <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
{{--                                    @dd($item)--}}
                                    <td>{{ ++$loop->index }}</td>
                                    <td>
                                        <img src="{{ getUserImage($item->image) }}" width="50px"
                                             height="50px" alt="">
                                    </td>
                                    <td>{{ucwords($item->full_name)}}</td>
                                    <td>{{ $item->doctorInfos->departments->name ?? '' }}</td>
                                    <td>{{ ucwords($item->doctorInfos->designation ?? '')}}</td>
                                    <td>{{ ucwords($item->doctorInfos->speciality ?? '') }}</td>
                                    <td>{{ ucwords($item->doctorInfos->doctor_type ?? '') }}</td>
                                    @if(checkUserRole('action.doctor.index'))
                                        <td>
                                            <a href="{{route('doctor.history.index', $item->id)}}"
                                               class="btn btn-warning mb-1 f-11"><i class="fas fa-plus-circle"></i>&nbsp;
                                                History</a>

                                            @if(checkUserRole('doctor.show'))
                                                <a href="{{route('doctor.show', $item->id)}}" class="btn btn-info f-11"><i
                                                        class="fas fa-info"></i>&nbsp; Info</a>
                                            @endif
                                            @if(checkUserRole('doctor.update'))
                                                <a href="{{route('doctor.edit', $item->id)}}"
                                                   class="btn btn-primary f-12"><i class="fas fa-edit"></i>&nbsp;
                                                    Edit</a>
                                            @endif
                                            @if(checkUserRole('doctor.destroy'))
                                                <form id="delete-form-{{ $loop->index }}"
                                                      action="{{ route('doctor.destroy', $item->id) }}"
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
