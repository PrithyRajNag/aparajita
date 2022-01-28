@extends('com_layouts.master')
@section('comContent')
    <!-- Start Company Module Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
{{--            <div id="success-msg" class="alert alert-success"></div>--}}
            @if(session('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {{ session('success') }}
                </div>
            @endif
            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Module List</span>
{{--                    <a href="#" class="btn btn-light" data-toggle="modal" data-target="#add"><i--}}
{{--                            class="fas fa-plus-circle"></i>&nbsp; Add</a>--}}
                </h4>
                <div class="card-body f-14">
                    <div class="table-responsive" id="showModuleList">
                        <table class="table table-striped text-canter">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Module Name</th>
                                <th>Remarks</th>
                                <th>Status</th>
{{--                                <th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->note}}</td>
                                    <td>
                                        @include('layouts.partials.status', ['status' => $item->status ])
                                    </td>
{{--                                    <td>--}}
{{--                                        <a href="" class="btn btn-primary f-12" onclick="showData({{ $item }})"--}}
{{--                                           data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i>&nbsp;--}}
{{--                                            Edit</a>--}}
{{--                                        <form id="delete-form-{{ $loop->index }}"--}}
{{--                                              action="{{ route('company.module.destroy', $item->id) }}"--}}
{{--                                              method="post"--}}
{{--                                              class="form-horizontal d-inline">--}}
{{--                                            {{ csrf_field() }}--}}
{{--                                            <input type="hidden" name="_method" value="DELETE">--}}
{{--                                            <div class="btn-group">--}}
{{--                                                <button onclick="deleteData({{ $loop->index }})" type="button"--}}
{{--                                                        class="btn btn-danger waves-effect waves-light btn-sm align-items-center">--}}
{{--                                                    <i class="fas fa-trash"></i>&nbsp; Delete--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Company Module Model -->

    <!-- Start Add Company Module Model -->
{{--    @include('company.module.create')--}}
    <!-- End Add Company Module Model -->


    <!-- Start Edit Company Module Model -->
{{--    @include('company.module.edit')--}}
    <!-- End Edit Company Module Model -->

@endsection
@push('comCustomScripts')
{{--    <script>--}}
{{--        // Script(For Create)--}}
{{--        $('#createForm').on('submit', function (e) {--}}
{{--            e.preventDefault();--}}

{{--            $.ajax({--}}
{{--                url: '/company/module/store',--}}
{{--                method: "POST",--}}
{{--                data: $(this).serialize(),--}}
{{--                beforeSend: function () {--}}
{{--                    $('#createBtn').attr('disabled', true);--}}
{{--                },--}}

{{--                success: function (response) {--}}
{{--                    // console.log(response);--}}
{{--                    $("#success-msg").text(response);--}}
{{--                    $('#add').modal('hide');--}}
{{--                    setInterval('location.reload()', 5000);--}}
{{--                },--}}
{{--                error: function (xhr, status, error) {--}}
{{--                    // console.log(xhr.responseText)--}}
{{--                    let errors = JSON.parse(xhr.responseText);--}}
{{--                    if  (! errors.hasOwnProperty("errors")) {--}}
{{--                        $("#error-msg").text(errors.message);--}}
{{--                        $('#createBtn').attr('disabled', true);--}}
{{--                        return;--}}
{{--                    }--}}
{{--                    if (errors.errors.hasOwnProperty("name")) {--}}
{{--                        $("#name_error").text(errors.errors.name[0]);--}}
{{--                    }--}}
{{--                    if (errors.errors.hasOwnProperty("note")) {--}}
{{--                        $("#note_error").text(errors.errors.note[0]);--}}
{{--                    }--}}
{{--                    if (errors.errors.hasOwnProperty("status")) {--}}
{{--                        $("#status_error").text(errors.errors.status[0]);--}}
{{--                    }--}}
{{--                },--}}
{{--            })--}}
{{--        })--}}



{{--        // Script(To show Data)--}}
{{--        function showData(item) {--}}

{{--            $("input[name*='id']").val(item.id);--}}
{{--            $("input[name*='name']").val(item.name);--}}
{{--            $("textarea[name*='note']").val(item.note);--}}
{{--            $('#status').prepend($('<option>', {--}}
{{--                value: item.status,--}}
{{--                text: item.status === 1 ? 'Active' : 'Inactive'--}}
{{--            }).attr({'selected':'selected', 'hidden':'hidden'}));--}}
{{--        }--}}

{{--        // Script(For Update)--}}
{{--        $('#editForm').on('submit', function (e) {--}}
{{--            e.preventDefault();--}}
{{--            let id  = $("input[name*='id']").val();--}}
{{--            let name  = $("#name").val();--}}
{{--            let note  = $("#note").val();--}}
{{--            let status  = $("#status").val();--}}
{{--            console.log(status);--}}
{{--            $.ajax({--}}
{{--                url: '/company/module/'+ id + '/update',--}}
{{--                method: "PUT",--}}
{{--                data: {--}}
{{--                    _token: "{{ csrf_token() }}",--}}
{{--                    name: name,--}}
{{--                    note: note,--}}
{{--                    status: status,--}}
{{--                },--}}
{{--                success: function(response) {--}}
{{--                    if(response) {--}}
{{--                        $("#success-msg").text(response);--}}
{{--                        $('#edit').modal('hide');--}}
{{--                        setInterval('location.reload()', 5000);--}}
{{--                    }--}}
{{--                },--}}
{{--                error: function (xhr, status, error) {--}}
{{--                    let errors = JSON.parse(xhr.responseText);--}}
{{--                    if  (! errors.hasOwnProperty("errors")) {--}}
{{--                        $("#error-msg").text(errors.message);--}}
{{--                        // $('#editBtn').attr('disabled', true);--}}
{{--                        return;--}}
{{--                    }--}}
{{--                    if (errors.errors.hasOwnProperty("name")) {--}}
{{--                        $("#update_name_error").text(errors.errors.name[0]);--}}
{{--                    }--}}
{{--                    if (errors.errors.hasOwnProperty("note")) {--}}
{{--                        $("#update_note_error").text(errors.errors.note[0]);--}}
{{--                    }--}}
{{--                    if (errors.errors.hasOwnProperty("driver_license")) {--}}
{{--                        $("#update_status_error").text(errors.errors.end_date[0]);--}}
{{--                    }--}}
{{--                },--}}
{{--            })--}}
{{--        })--}}
{{--        // Script(For Delete)--}}
{{--        function deleteData(id) {--}}
{{--            Swal.fire({--}}
{{--                title: 'Are you sure?',--}}
{{--                text: "You won't be able to revert this!",--}}
{{--                type: 'warning',--}}
{{--                showCancelButton: true,--}}
{{--                confirmButtonColor: '#3085D6',--}}
{{--                cancelButtonColor: '#d33',--}}
{{--                confirmButtonText: 'Yes, delete it!'--}}
{{--            }).then((result) => {--}}
{{--                // console.log(result);--}}
{{--                if (result.value) {--}}
{{--                    document.getElementById('delete-form-' + id).submit();--}}
{{--                    setTimeout(2000);--}}
{{--                    Swal.fire(--}}
{{--                        'Deleted!',--}}
{{--                        'Your file has been deleted.',--}}
{{--                        'success'--}}
{{--                    )--}}
{{--                }--}}
{{--            })--}}
{{--        }--}}
{{--    </script>--}}
@endpush
