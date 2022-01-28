@extends('com_layouts.master')
@section('comContent')
    <!-- Start Organization List Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            @if(session('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('success') }}
                </div>
            @endif
            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Organization List</span>
                    <a href="{{route('company.organization.create')}}" id="createFormBtn" class="btn btn-light"><i class="fas fa-plus-circle"></i>&nbsp; ADD</a>
                </h4>
                <div class="card-body f-14">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter table-col-bar">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Organization Name</th>
                                <th>Owner</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ ucwords( $item->organization->name ) }}</td>
                                    <td>{{ ucwords( $item->full_name ) }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
{{--                                        <a href="{{route('company.organization.show', $item->id)}}" class="btn btn-info f-11"><i class="fas fa-info"></i>&nbsp; Info</a>--}}
                                        <a href="{{route('company.organization.edit', $item->id)}}" class="btn btn-primary f-12"><i class="fas fa-edit"></i>&nbsp; Edit</a>
                                        <form id="delete-form-{{ $loop->index }}" action="{{ route('company.organization.destroy', $item->id) }}"
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
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Organization List Model -->

{{--    <!-- Start Add New Organization Model -->--}}
{{--    @include('company.organization.create')--}}
{{--    <!-- End Add New Organization Model -->--}}

{{--    <!-- Start Edit Organization Model -->--}}
{{--    @include('company.organization.edit')--}}
{{--    <!-- End Edit Organization Model -->--}}

@endsection
@push('comCustomScripts')
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
            }).then((result) => {
                if (result.value) {
                    document.getElementById('delete-form-' + id).submit();
                    setTimeout(2000);
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
