@extends('layouts.master')
@section('content')
    <!-- Start All Staff List Model -->
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
                    <span class="text-light align-self-center">Staff List</span>
                    @if(checkUserRole('staff.store'))
                        <a href="{{route('staff.create')}}" id="createFormBtn" class="btn btn-light"><i
                                class="fas fa-plus-circle"></i>&nbsp; ADD</a>
                    @endif
                </h4>
                <div class="card-body f-14">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Role</th>
                                @if(checkUserRole('action.staff.index'))
                                    <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
                                    <td>
{{--                                        <img src="{{ asset('/storage/images/'. $item->image) }}" width="50px"--}}
{{--                                             height="50px" alt="">--}}
                                        <img src="{{ getUserImage($item->image) }}" width="50px"
                                             height="50px" alt="">
                                    </td>
                                    <td>{{ $item->user_unique_id}}</td>
                                    <td>{{ucwords($item->full_name)}}</td>
                                    <td>{{ ucwords($item->phone_number)}}</td>
                                    <td>{{ ucwords(getRoleName($item))}}</td>
                                    @if(checkUserRole('action.staff.index'))
                                        <td>
                                            @if(checkUserRole('staff.show'))
                                                <a href="{{route('staff.show', $item->id)}}"
                                                   class="btn btn-info f-11"><i
                                                        class="fas fa-info"></i>&nbsp; Info</a>
                                            @endif
                                            @if(checkUserRole('staff.update'))
                                                <a href="{{route('staff.edit', $item->id)}}"
                                                   class="btn btn-primary f-12"><i
                                                        class="fas fa-edit"></i>&nbsp; Edit</a>
                                            @endif
                                            @if(checkUserRole('staff.destroy'))
                                                <form id="delete-form-{{ $loop->index }}"
                                                      action="{{ route('staff.destroy', $item->id) }}"
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
    <!-- End All Staff List Model -->

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
