@extends('layouts.master')
@section('content')
    <!-- Start Death Report List Model -->
    <div class="row justify-content-center">
        <div class="col-sm-12 m-3">
            <div id="success-msg" class="alert alert-success"></div>

            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="modal-title text-light align-self-center">Death Report</span>
                    @if(checkUserRole('death.store'))
                        <a href="#" id="createFormBtn" class="btn btn-light" data-toggle="modal" data-target="#add"><i
                                class="fas fa-plus-circle"></i>&nbsp; ADD</a>
                    @endif
                </h4>
                <div class="card-body f-12">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter">
                            <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Death Date</th>
                                <th>Death Time</th>
                                <th>Guardian Phone</th>
                                <th>Note</th>
                                @if(checkUserRole('action.death'))
                                    <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
                                    <td>
                                        <a href="{{route('patient.show', $item->patient->id)}}" type="button"
                                           class="text-info">{{ ucwords($item->patient->full_name) }}</a>
                                    </td>
                                    <td>{{ normalDateFormat($item->date)}}</td>
                                    <td>{{ Carbon\Carbon::parse($item->time)->format('H:i:s')}}</td>

                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ ucwords($item->note) }}</td>
                                    @if(checkUserRole('action.death'))
                                        <td>
                                            @if(checkUserRole('death.show'))
                                                <a href="#" class="btn btn-success f-12" onclick="show({{ $item }})"
                                                   data-toggle="modal" data-target="#info"><i class="fas fa-edit"></i>&nbsp;
                                                    Info</a>
                                            @endif
                                            @if(checkUserRole('death.update'))
                                                <a href="" class="btn btn-primary f-12" onclick="showData({{ $item }})"
                                                   data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i>&nbsp;
                                                    Edit</a>
                                            @endif
                                            @if(checkUserRole('death.destroy'))
                                                <form id="delete-form-{{ $loop->index }}"
                                                      action="{{ route('death.destroy', $item->id) }}"
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

{{--                                            @if(checkUserRole('death.pdf'))--}}
                                                <a href="{{route('death.pdf', $item->id)}}"
                                                   class="btn btn-info btn-sm align-items-center"><i
                                                        class="fas fa-file-pdf"></i>&nbsp;PDF</a>
{{--                                            @endif--}}

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
    <!-- End Death Report List Model -->

    <!-- Start Add New Death Report Model -->
    @include('death.create')
    <!-- End Add New Death Report Model -->

    <!-- Start Edit Death Report Model -->
    @include('death.edit')
    <!-- End Edit Death Model -->

    <!-- Start Death Info Model -->
    @include('death.info')
    <!-- End Death Info Model -->
@endsection
@push('customScripts')
    <script>

        // Script(For Create)
        $('#createForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '/death/store',
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
                    if (errors.errors.hasOwnProperty("phone_number")) {
                        $("#phone_number_error").text(errors.errors.phone_number[0]);
                    }
                    if (errors.errors.hasOwnProperty("date")) {
                        $("#date_error").text(errors.errors.date[0]);
                    }
                    if (errors.errors.hasOwnProperty("time")) {
                        $("#time_error").text(errors.errors.time[0]);
                    }
                    if (errors.errors.hasOwnProperty("patient_id")) {
                        $("#patient_id_error").text(errors.errors.patient_id[0]);
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
            console.log('ShowData')
            console.log(item)
            $("input[name*='id']").val(item.id);
            $("select[name*='patient_id']").val(item.patient_id);
            $("select[name*='doctor_id']").val(item.doctor_id);
            // console.log(item.patient_id);
            $("input[name*='phone_number']").val(item.phone_number);
            $("input[name*='date']").val(item.date);
            $("input[name*='time']").val(item.time);
            $("textarea[name*='note']").val(item.note);

            $('#patient_id').prepend($('<option>', {
                value: item.patient_id,
                text: item.patient.first_name +" "+ item.patient.last_name,
            }).attr({'selected': 'selected', 'hidden': 'hidden'}));
            $('#doctor_id').prepend($('<option>', {
                value: item.doctor_id,
                text: item.doctors.first_name +" "+ item.doctors.last_name,
            }).attr({'selected': 'selected', 'hidden': 'hidden'}));
        }
        function show(item) {
            // console.log('Show');
            console.log(item);
            // console.log(item.doctors);

            $("#show_name").text(item.patient.first_name + " " + item.patient.last_name);
            $("#show_phone_number").text(item.phone_number);
            $("#show_date").text(item.date);
            $("#show_time").text(item.time);
            $("#show_doctor").text(item.doctors.first_name + " " + item.doctors.last_name);
            $("#show_note").text(item.note);

        }

        // Script(For Update)
        $('#editForm').on('submit', function (e) {
            e.preventDefault();

            let id = $("input[name*='id']").val();
            let patient_id = $("#patient_id").val();
            let doctor_id = $("#doctor_id").val();
            let phone_number = $("#phone_number").val();
            let date = $("#date").val();
            let time = $("#time").val();
            let note = $("#note").val();
            $.ajax({
                url: '/death/' + id + '/update',
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    patient_id: patient_id,
                    doctor_id: doctor_id,
                    phone_number: phone_number,
                    date: date,
                    time: time,
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
                    if (errors.errors.hasOwnProperty("phone_number")) {
                        $("#update_phone_number_error").text(errors.errors.phone_number[0]);
                    }
                    if (errors.errors.hasOwnProperty("date")) {
                        $("#update_date_error").text(errors.errors.date[0]);
                    }
                    if (errors.errors.hasOwnProperty("time")) {
                        $("#update_time_error").text(errors.errors.time[0]);
                    }
                    if (errors.errors.hasOwnProperty("patient_id")) {
                        $("#update_patient_id_error").text(errors.errors.patient_id[0]);
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
