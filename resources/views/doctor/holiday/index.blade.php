@extends('layouts.master')
@section('content')
    <!-- Start Doctors Holiday List Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            <div id="success-msg" class="alert alert-success"></div>

            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Doctors Holiday</span>
                    @if(checkUserRole('doctor.holidays.store'))
                        <a href="#" id="createFormBtn" class="btn btn-light" data-toggle="modal" data-target="#add"><i
                                class="fas fa-plus-circle"></i>&nbsp; ADD</a>
                    @endif
                </h4>
                <div class="card-body f-14">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter table-col-bar">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Doctor Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th width="300px">Note</th>
                                @if(checkUserRole('action.doctor.holidays'))
                                    <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>
                                        <a href="{{route('doctor.show', $item->doctors->id)}}" type="button"
                                           class="text-info">{{  ucwords($item->doctors->full_name) }}</a>
                                    </td>
                                    <td>{{ normalDateFormat($item->start_date)}}</td>
                                    <td>{{ normalDateFormat($item->end_date)}}</td>
                                    <td>{{ ucwords($item->note) }}</td>
                                    @if(checkUserRole('action.doctor.holidays'))
                                        <td>
                                            @if(checkUserRole('doctor.holidays.update'))
                                                <a href="" class="btn btn-primary f-12" onclick="showData({{ $item }})"
                                                   data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i>&nbsp;
                                                    Edit</a>
                                            @endif
                                            @if(checkUserRole('doctor.holidays.destroy'))
                                                <form id="delete-form-{{ $loop->index }}"
                                                      action="{{ route('doctor.holiday.destroy', $item->id) }}"
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
    <!-- End Doctors Doctors Holiday List Model -->

    <!-- Start New Doctors Holiday Model -->
    @include('doctor.holiday.create')
    <!-- End New Doctors Holiday Model -->

    <!-- Start Edit Doctors Holiday Model -->
    @include('doctor.holiday.edit')
    <!-- End Edit Doctors Holiday Model -->

@endsection
@push('customScripts')
    <script>
        // Script(For Create)
        $('#createForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '/doctor/holiday/store',
                method: "POST",
                data: $(this).serialize(),
                beforeSend: function () {
                    $('#createBtn').attr('disabled', true);
                },
                error: function (xhr, status, error) {
                    let errors = JSON.parse(xhr.responseText);
                    if (!errors.hasOwnProperty("errors")) {
                        $("#error-msg").text(errors.message);
                        $('#createBtn').attr('disabled', true);
                        return;
                    }
                    if (errors.errors.hasOwnProperty("start_date")) {
                        $("#start_date_error").text(errors.errors.start_date[0]);
                    }
                    if (errors.errors.hasOwnProperty("end_date")) {
                        $("#end_date_error").text(errors.errors.end_date[0]);
                    }
                    if (errors.errors.hasOwnProperty("doctor_id")) {
                        $("#doctor_id_error").text(errors.errors.doctor_id[0]);
                    }

                },
                success: function (response) {
                    $("#success-msg").text(response);
                    $('#add').modal('hide');
                    setInterval('location.reload()', 1000);

                },
            })
        })

        // Script(To show Data)
        function showData(item) {
            $("input[name*='id']").val(item.id);
            $("input[name*='start_date']").val(item.start_date);
            $("input[name*='end_date']").val(item.end_date);
            $("select[name*='doctor_id']").val(item.doctor_id);
            $("textarea[name*='note']").val(item.note);
        }

        // Script(For Update)
        $('#editForm').on('submit', function (e) {
            e.preventDefault();

            let id = $("input[name*='id']").val();
            let start_date = $("#start_date").val();
            let end_date = $("#end_date").val();
            let doctor_id = $("#doctor_id").val();
            let note = $("#note").val();
            $.ajax({
                url: '/doctor/holiday/' + id + '/update',
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    start_date: start_date,
                    end_date: end_date,
                    doctor_id: doctor_id,
                    note: note
                },
                success: function (response) {
                    if (response) {
                        $("#success-msg").text(response);
                        // console.log(response);
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
                    if (errors.errors.hasOwnProperty("start_date")) {
                        $("#update_start_date_error").text(errors.errors.start_date[0]);
                    }
                    if (errors.errors.hasOwnProperty("end_date")) {
                        $("#update_end_date_error").text(errors.errors.end_date[0]);
                    }
                    if (errors.errors.hasOwnProperty("doctor_id")) {
                        $("#update_doctor_id_error").text(errors.errors.doctor_id[0]);
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
