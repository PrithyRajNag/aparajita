@extends('layouts.master')
@section('content')
    <!-- Start Department List Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            <div id="success-msg" class="alert alert-success"></div>

            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Departments List</span>
                    @if(checkUserRole('department.store'))
                        <a href="#" id="createFormBtn" class="btn btn-light" data-toggle="modal" data-target="#add"><i
                                class="fas fa-plus-circle"></i>&nbsp; Add</a>
                    @endif
                </h4>
                <div class="card-body f-14">
                    <div class="table-responsive" id="showDepartmentList">
                        <table class="table table-striped text-center">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Departments Name</th>
                                <th>Description</th>
                                @if(checkUserRole('action.department'))
                                    <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->description}}</td>
                                    @if(checkUserRole('action.department'))
                                        <td>
                                            @if(checkUserRole('department.update'))
                                                <a href="" class="btn btn-primary f-12" onclick="showData({{ $item }})"
                                                   data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i>&nbsp;
                                                    Edit</a>
                                            @endif
                                            @if(checkUserRole('department.destroy'))
                                                <form id="delete-form-{{ $loop->index }}"
                                                      action="{{ route('department.destroy', $item->id) }}"
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
    <!-- End Department List Model -->

    <!-- Start Add New Department Model -->
    @include('department.create')
    <!-- End Add New Department Model -->

    <!-- Start Edit Department Model -->
    @include('department.edit')
    <!-- End Edit Department Model -->

@endsection

@push('customScripts')
    <script>

        $('#createFormBtn').click(function () {
            $('#name_error').text('');
            $('#description_error').text('');
            $('#createBtn').attr('disabled', false);
        });

        // Browser validation



        // Script(To show Data)
        function showData(item) {

            $("input[name*='id']").val(item.id);
            $("input[name*='name']").val(item.name);
            $("textarea[name*='description']").val(item.description);
        }

        // Script(For Create)
        $('#createForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '/department/store',
                method: "POST",
                data: $(this).serialize(),
                beforeSend: function () {
                    $('#createBtn').attr('disabled', true);
                },
                success: function (response) {
                    $("#success-msg").text(response);
                    $('#add').modal('hide');
                    setInterval('location.reload()', 1000);
                },
                error: function (xhr, status, error) {
                    let errors = JSON.parse(xhr.responseText);
                    let errorName = errors.errors.name[0];
                    $("#name_error").text(errorName);
                },
            })
        })


        // Script(For Update)
        $('#editForm').on('submit', function (e) {
            e.preventDefault();
            console.log('Inserted');
            let id = $("input[name*='id']").val();
            let name = $("#name").val();
            let description = $("#description").val();
            $.ajax({
                url: '/department/' + id + '/update',
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name,
                    description: description,
                },
                success: function (response) {
                    if (response) {
                        $("#success-msg").text(response);
                        $('#edit').modal('hide');
                        setInterval('location.reload()', 1000);
                    }
                },
                error: function (xhr, status, error) {
                    let errors = JSON.parse(xhr.responseText);
                    if (!errors.hasOwnProperty("errors")) {
                        $("#error-msg").text(errors.message);
                        // $('#editBtn').attr('disabled', true);
                        return;
                    }
                    if (errors.errors.hasOwnProperty("name")) {
                        $("#update_name_error").text(errors.errors.name[0]);
                    }

                },
            })
        })

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
