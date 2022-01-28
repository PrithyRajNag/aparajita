@extends('layouts.master')
@section('content')
    <!-- Start Notice Board Model -->
    <div class="row justify-content-center">
        <div class="col-sm-12 m-3">
            <div id="success-msg" class="alert alert-success"></div>

            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="modal-title text-light align-self-center">Notice Board</span>
                    @if(checkUserRole('notice.store'))
                        <a href="#" id="createFormBtn" class="btn btn-light" data-toggle="modal" data-target="#add"><i
                                class="fas fa-plus-circle"></i>&nbsp; ADD</a>
                    @endif
                </h4>
                <div class="card-body f-12">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Role</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                @if(checkUserRole('action.notice'))
                                    <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>{{ucwords( $item->roles->name )}}</td>
                                    <td>{{ normalDateFormat($item->start_date)}}</td>
                                    <td>{{ normalDateFormat($item->end_date) }}</td>
                                    <td>
                                        @include('layouts.partials.status', ['status' => $item->status ])
                                    </td>
                                    @if(checkUserRole('action.notice'))
                                        <td>
                                            @if(checkUserRole('notice.update'))
                                                <a href="" class="btn btn-primary f-12" onclick="showData({{ $item }})"
                                                   data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i>&nbsp;
                                                    Edit</a>
                                            @endif
                                            @if(checkUserRole('notice.destroy'))
                                                <form id="delete-form-{{ $loop->index }}"
                                                      action="{{ route('notice.destroy', $item->id) }}"
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
    <!-- End Notice Board List Model -->

    <!-- Start Add New Notice Model -->
    @include('notice.create')
    <!-- End Add New Notice Model -->

    <!-- Start Edit Notice Model -->
    @include('notice.edit')
    <!-- End Edit Notice Model -->
@endsection
@push('customScripts')
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

        // Script(For Create)
        $('#createForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '/notice/store',
                method: "POST",
                data: $(this).serialize(),
                beforeSend: function () {
                    // $('#createBtn').attr('disabled', true);
                },

                success: function (response) {
                    // console.log(response);
                    $("#success-msg").text(response);
                    $('#add').modal('hide');
                    setInterval('location.reload()', 1000);
                },
                error: function (xhr, status, error) {
                    // console.log(xhr.responseText)
                    let errors = JSON.parse(xhr.responseText);
                    if (!errors.hasOwnProperty("errors")) {
                        $("#error-msg").text(errors.message);
                        $('#createBtn').attr('disabled', true);
                        return;
                    }
                    if (errors.errors.hasOwnProperty("role_id")) {
                        $("#role_error").text(errors.errors.role_id[0]);
                    }
                    if (errors.errors.hasOwnProperty("title")) {
                        $("#title_error").text(errors.errors.title[0]);
                    }
                    if (errors.errors.hasOwnProperty("description")) {
                        $("#description_error").text(errors.errors.description[0]);
                    }
                    if (errors.errors.hasOwnProperty("start_date")) {
                        $("#start_date_error").text(errors.errors.start_date[0]);
                    }
                    if (errors.errors.hasOwnProperty("end_date")) {
                        $("#end_date_error").text(errors.errors.end_date[0]);
                    }
                    if (errors.errors.hasOwnProperty("status")) {
                        $("#status_error").text(errors.errors.status[0]);
                    }
                },
            })
        })

        // Script(To show Data)
        function showData(item) {

            $("input[name*='id']").val(item.id);
            $("input[name*='title']").val(item.title);
            $("textarea[name*='description']").val(item.description);
            $("input[name*='start_date']").val(item.start_date);
            $("input[name*='end_date']").val(item.end_date);
            $("select[name*='role_id']").val(item.role_id);
            $('#status').prepend($('<option>', {
                value: item.status,
                text: item.status === 1 ? 'Active' : 'Inactive'
            }).attr({'selected': 'selected', 'hidden': 'hidden'}));
        }

        // Script(For Update)
        $('#editForm').on('submit', function (e) {
            e.preventDefault();
            let id = $("input[name*='id']").val();
            let title = $("#title").val();
            let description = $("#description").val();
            let start_date = $("#start_date").val();
            let end_date = $("#end_date").val();
            let status = $("#status").val();
            console.log(status);
            $.ajax({
                url: '/notice/' + id + '/update',
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    title: title,
                    description: description,
                    start_date: start_date,
                    end_date: end_date,
                    status: status,
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
                    if (errors.errors.hasOwnProperty("role_id")) {
                        $("#update_role_error").text(errors.errors.role_id[0]);
                    }
                    if (errors.errors.hasOwnProperty("title")) {
                        $("#update_title_error").text(errors.errors.title[0]);
                    }
                    if (errors.errors.hasOwnProperty("description")) {
                        $("#update_description_error").text(errors.errors.description[0]);
                    }
                    if (errors.errors.hasOwnProperty("start_date")) {
                        $("#update_start_date_error").text(errors.errors.start_date[0]);
                    }
                    if (errors.errors.hasOwnProperty("end_date")) {
                        $("#update_end_date_error").text(errors.errors.end_date[0]);
                    }
                    if (errors.errors.hasOwnProperty("status")) {
                        $("#update_status_error").text(errors.errors.status[0]);
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
