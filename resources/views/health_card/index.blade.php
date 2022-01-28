@extends('layouts.master')
@section('content')
    <!-- Start Health Card Model -->
    <div class="row justify-content-center">
        <div class="col-sm-12 m-3">
            <div id="success-msg" class="alert alert-success"></div>


            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Health Card</span>
                    @if(checkUserRole('healthCard.store'))
                        <a href="#" class="btn btn-light" data-toggle="modal" data-target="#add"><i
                                class="fas fa-plus-circle"></i>&nbsp; Add</a>
                    @endif
                </h4>
                <div class="card-body f-14">
                    <div class="table-responsive" id="showDoctorList">
                        <table class="table table-striped text-canter table-col-bar">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Patient Name</th>
                                <th>Cellphone</th>
                                <th>Card Number</th>
                                <th>Issue Date</th>
                                <th>Expiry Date</th>
                                @if(checkUserRole('action.healthCard'))
                                    <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
{{--                            {{ var_dump($patients) }}--}}

                            @foreach($contentData as $item)
                                <tr>
                                    <td>
                                        <img src="{{ getUserImage($item->patient->image )}}"
                                             class="rounded-circle" width="40px"
                                             height="40px">
                                    </td>
                                    <td>
                                        <a href="{{route('patient.show', $item->patient->id)}}" type="button"
                                           class="text-info">{{ ucwords($item->patient->full_name) }}</a>
                                    </td>
                                    <td>{{ $item->patient->phone_number}}</td>
                                    <td>{{ $item->card_number }}</td>
                                    <td>{{ normalDateFormat($item->issue_date)}}</td>
                                    <td>{{ normalDateFormat($item->expire_date)}}</td>
                                    @if(checkUserRole('action.healthCard'))
                                        <td>
                                            @if(checkUserRole('healthCard.show'))
                                                <a href="#" class="btn btn-info f-12" onclick="show({{ $item }})"
                                                   data-toggle="modal" data-target="#info"><i class="fas fa-plus-circle"></i>&nbsp;
                                                    Info</a>
                                            @endif
                                            @if(checkUserRole('healthCard.update'))
                                                <a href="#" class="btn btn-primary f-12" onclick="showData({{ $item }})"
                                                   data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i>&nbsp;
                                                    Edit</a>
                                            @endif
                                            @if(checkUserRole('healthCard.destroy'))
                                                <form id="delete-form-{{ $loop->index }}"
                                                      action="{{ route('health-card.destroy', $item->id) }}"
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
    <!-- End Health Card Model -->

    <!-- Start Add Health Card Model -->
    @include('health_card.create')
    <!-- End Add Health Card Model -->

    <!-- Start View Health Card Model -->
    @include('health_card.info')
    <!-- End View Health Card Model -->

    <!-- Start Edit Health Card Model -->
    @include('health_card.edit')
    <!-- End Edit Health Card Model -->
@endsection
@push('customScripts')
    <script>

        // Script(For Create)
        $('#createForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '/health-card/store',
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
                    if (errors.errors.hasOwnProperty("card_number")) {
                        $("#card_number_error").text(errors.errors.card_number[0]);
                    }
                    if (errors.errors.hasOwnProperty("expire_date")) {
                        $("#expire_date_error").text(errors.errors.expire_date[0]);
                    }
                    if (errors.errors.hasOwnProperty("issue_date")) {
                        $("#issue_date_error").text(errors.errors.issue_date[0]);
                    }
                    if (errors.errors.hasOwnProperty("note")) {
                        $("#note_error").text(errors.errors.note[0]);
                    }
                    if (errors.errors.hasOwnProperty("patient_id")) {
                        $("#patient_id_error").text(errors.errors.patient_id[0]);
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
            // console.log('ShowData')
            // console.log(item)
            $("input[name*='id']").val(item.id);
            $("input[name*='card_number']").val(item.card_number);
            $("input[name*='issue_date']").val(item.issue_date);
            $("input[name*='expire_date']").val(item.expire_date);
            $("textarea[name*='note']").val(item.note);
            $('#patient_id').prepend($('<option>', {
                value: item.patient_id,
                text: item.patient.first_name + " " + item.patient.last_name,
            }).attr({'selected': 'selected', 'hidden': 'hidden'}));
        }


        function show(item) {

            console.log(item);
            $("#img").html(
{{--                '<img src={{ getUserImage($item->patient->image) }} class="img-fluid mt-2 p-2">'--}}
            );
            $("#show_patient_name").text(item.patient.first_name + " " + item.patient.last_name);
            $("#show_phone_number").text(item.patient.phone_number);
            $("#show_card_number").text(item.card_number);
            $("#show_issue_date").text(item.issue_date);
            $("#show_expire_date").text(item.expire_date);
            $("#show_note").text(item.note);
        }




        // Script(For Update)
        $('#editForm').on('submit', function (e) {
            e.preventDefault();

            let id = $("input[name*='id']").val();
            let patient_id = $("#patient_id").val();
            let card_number = $("#card_number").val();
            let issue_date = $("#issue_date").val();
            let expire_date = $("#expire_date").val();
            let note = $("#note").val();
            $.ajax({
                url: '/health-card/' + id + '/update',
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    patient_id: patient_id,
                    card_number: card_number,
                    issue_date: issue_date,
                    expire_date: expire_date,
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
                    console.log('Error')
                    let errors = JSON.parse(xhr.responseText);

                    console.log(errors)
                    if (!errors.hasOwnProperty("errors")) {
                        $("#error-msg").text(errors.message);
                        // $('#editBtn').attr('disabled', true);
                        return;
                    }
                    if (errors.errors.hasOwnProperty("card_number")) {
                        $("#update_card_number_error").text(errors.errors.card_number[0]);
                    }
                    if (errors.errors.hasOwnProperty("issue_date")) {
                        $("#update_issue_date_error").text(errors.errors.issue_date[0]);
                    }
                    if (errors.errors.hasOwnProperty("expire_date")) {
                        $("#update_expire_date_error").text(errors.errors.expire_date[0]);
                    }
                    if (errors.errors.hasOwnProperty("patient_id")) {
                        $("#update_patient_id_error").text(errors.errors.patient_id[0]);
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
