@extends('com_layouts.master')
@section('comContent')
<!-- Start All Staff List Model -->
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
                <span class="text-light align-self-center">Employee List</span>
                <a href="{{route('company.employee.create')}}" id="createFormBtn" class="btn btn-light"><i class="fas fa-plus-circle"></i>&nbsp; ADD</a>
            </h4>
            <div class="card-body f-14">
                <div class="table-responsive" id="">
                    <table class="table table-striped text-canter">
                        <thead>
                        <tr>
{{--                            <th>Image</th>--}}
                            <th>SL</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Designation</th>
                            <th>Option</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ $item->employee_unique_id}}</td>
                                    <td>{{ucwords($item->full_name)}}</td>
                                    <td>{{ ucwords($item->phone_number)}}</td>
                                    <td>{{ $item->designations->name}}</td>
                                    <td>
                                        <a href="{{route('company.employee.show', $item->id)}}" class="btn btn-info f-11"><i class="fas fa-info"></i>&nbsp; Info</a>
                                        <a href="{{route('company.employee.edit', $item->id)}}" class="btn btn-primary f-12"><i class="fas fa-edit"></i>&nbsp; Edit</a>
                                        <form id="delete-form-{{ $loop->index }}" action="{{ route('company.employee.destroy', $item->id) }}"
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
<!-- End All Staff List Model -->

@endsection


@push('comCustomScripts')
    <script>
        //        $('#createFormBtn').click(function() {
        //            $('#name_error').text('');
        //            $('#createBtn').attr('disabled', true);
        //        });
        //        // Browser validation
        //        $("input[name*='title']").keyup(function () {
        //            let value_input = $("input[name*='title']").val();
        //            // let regexp = /[^a-zA-Z. ]/g ;
        //            // if (value_input.match(regexp)) {
        //            //     $("input[name*='driver_name']").val(value_input.replace(regexp,''))
        //            // }
        //            if (value_input.length < 5) {
        //                $("#title_error").text("Minimum 5 Character Required");
        //                $('#createBtn').attr('disabled', true);
        //                return;
        //            }
        //            $("#title_error").text('');
        //            $('#createBtn').attr('disabled', false);
        //        });





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
