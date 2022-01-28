@extends('layouts.master')
@section('content')
    <!-- Start Bed Type Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            <div id="success-msg" class="alert alert-success"></div>

            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center"> Bed Type</span>
                    @if(checkUserRole('bed.type.store'))
                        <a href="#" id="createFormBtn" class="btn btn-light" data-toggle="modal" data-target="#add"><i
                                class="fas fa-plus-circle"></i>&nbsp; Add</a>
                    @endif
                </h4>
                <div class="card-body f-14">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Bed Type</th>
                                <th>Description</th>
                                <th>Status</th>
                                @if(checkUserRole('action.bed.type'))
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
                                    <td>
                                        @include('layouts.partials.status', ['status' => $item->status ])
                                    </td>
                                    @if(checkUserRole('action.bed.type'))
                                    <td>
                                        @if(checkUserRole('bed.type.update'))
                                            <a href="" class="btn btn-primary f-12" onclick="showData({{ $item }})"
                                               data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i>&nbsp;
                                                Edit</a>
                                        @endif
                                        @if(checkUserRole('bed.type.destroy'))
                                            <form id="delete-form-{{ $loop->index }}"
                                                  action="{{ route('bed.type.destroy', $item->id) }}"
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
    <!-- End Bed Type Model -->

    <!-- Start New Bed Type Model -->
    @include('bed.type.create')
    <!-- End New Bed Type Model -->

    <!-- Start Edit Bed Type Model -->
    @include('bed.type.edit')
    <!-- End Edit Bed Type Model -->
@endsection

@push('customScripts')
    <script>

        // Script(To show Data)
        function showData(item) {
            $("input[name*='id']").val(item.id);
            $("input[name*='name']").val(item.name);
            // $("input[name*='status']").val(item.status);
            $("input[name*='description']").val(item.description);
            console.log(item.status)

            $('#status').prepend($('<option>', {
                value: item.status,
                text: item.status === 1 ? 'Active' : 'Inactive'
            }).attr({'selected': 'selected', 'hidden': 'hidden'}));
        }

        // Script(For Create)
        $('#createForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '/bed/type/store',
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
                    if (!errors.hasOwnProperty("errors")) {
                        $("#error-msg").text(errors.message);
                        $('#createBtn').attr('disabled', true);
                        return;
                    }
                    if (errors.errors.hasOwnProperty("name")) {
                        $("#name_error").text(errors.errors.name[0]);
                        $("#status_error").text(errors.errors.status[0]);
                        $("#description_error").text(errors.description.name[0]);
                    }

                },
            })
        })
        // Script(For Update)
        $('#editForm').on('submit', function (e) {
            e.preventDefault();
            let id = $("input[name*='id']").val();
            let name = $("#name").val();
            let status = $("#status").val();
            let description = $("#description").val();
            $.ajax({
                url: '/bed/type/' + id + '/update',
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name,
                    status: status,
                    description: description,

                },
                success: function (response) {
                    $("#success-msg").text(response);
                    $('#edit').modal('hide');
                    setInterval('location.reload()', 1000);
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
                        $("#update_status_error").text(errors.errors.status[0]);
                        $("#update_description_error").text(errors.errors.description[0]);
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
