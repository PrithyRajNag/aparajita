@extends('layouts.master')
@section('content')
    <!-- Start Lab Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            <div id="success-msg" class="alert alert-success"></div>

            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Lab</span>

                    <a href="#" class="btn btn-light" data-toggle="modal" data-target="#add"><i
                            class="fas fa-plus-circle"></i>&nbsp; ADD</a>

                </h4>
                <div class="card-body f-13">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter table-col-bar">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Lab Name</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ucwords($item->name)}}</td>
                                    <td>{{$item->address}}</td>

                                    <td>

                                        <a href="#" class="btn btn-primary btn-sm f-12" onclick="showData({{ $item }})"
                                           data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i></a>

                                        <form id="delete-form-{{ $loop->index }}"
                                              action="{{ route('lab.destroy', $item->id) }}"
                                              method="post"
                                              class="form-horizontal d-inline">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <div class="btn-group">
                                                <button onclick="deleteData({{ $loop->index }})" type="button"
                                                        class="btn btn-danger waves-effect waves-light btn-sm align-items-center f-12">
                                                    <i class="fas fa-trash"></i>
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
    <!-- End Lab Model -->

    <!-- Start Add New Lab Model -->
    @include('lab.create')
    <!-- End Add New Lab Model -->

    <!-- Start Edit Lab Model -->
    @include('lab.edit')
    <!-- End Edit Lab Model -->
@endsection

@push('customScripts')
    <script>

        $('#createFormBtn').click(function () {
            $('#name_error').text('');
            $('#address_error').text('');
            $('#createBtn').attr('disabled', false);
        });


        // Script(To show Data)
        function showData(item) {

            $("input[name*='id']").val(item.id);
            $("input[name*='name']").val(item.name);
            $("textarea[name*='address']").val(item.address);
        }

        // Script(For Create)
        $('#createForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '/lab/store',
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
                    $("#address_error").text(errorName);
                },

            })
        })


        // Script(For Update)
        $('#editForm').on('submit', function (e) {
            e.preventDefault();
            console.log('Inserted');
            let id = $("input[name*='id']").val();
            let name = $("#name").val();
            let address = $("#address").val();
            $.ajax({
                url: '/lab/' + id + '/update',
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name,
                    address: address,
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
                    if (errors.errors.hasOwnProperty("address")) {
                        $("#update_address_error").text(errors.errors.address[0]);
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
            }).then((result) => {
                if (result.value) {
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
