@extends('layouts.master')
@section('content')

    <!-- Start Birth Report List Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            <div id="success-msg" class="alert alert-success"></div>

            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="modal-title text-light align-self-center">Birth Report</span>
                    @if(checkUserRole('birth.store'))
                        <a href="#" id="createFormBtn" class="btn btn-light" data-toggle="modal" data-target="#add"><i
                                class="fas fa-plus-circle"></i>&nbsp; ADD</a>
                    @endif
                </h4>
                <div class="card-body f-12">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter table-col-bar">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Child Name</th>
                                <th>Gender</th>
{{--                                <th>Weight</th>--}}
{{--                                <th>Blood Group</th>--}}
                                <th>Mother Name</th>
                                <th>Father Name</th>
{{--                                <th>Note</th>--}}
                                @if(checkUserRole('action.birth'))
                                <th>Action</th>
                                    @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ ucwords($item->name) }}</td>
                                    <td>{{ ucwords($item->gender)}}</td>
{{--                                    <td>{{ $item->weight}}</td>--}}
{{--                                    <td>{{ ucwords($item->bloodGroup->name)}}</td>--}}
                                    <td>{{ ucwords($item->mother_name) }}</td>
                                    <td>{{ ucwords($item->father_name) }}</td>
{{--                                    <td>{{ ucwords($item->note) }}</td>--}}
                                    @if(checkUserRole('action.birth'))
                                    <td>
                                        @if(checkUserRole('birth.show'))
                                            <a href="#" class="btn btn-success f-12" onclick="show({{ $item }})"
                                               data-toggle="modal" data-target="#info"><i class="fas fa-edit"></i>&nbsp;
                                                Info</a>
                                        @endif
                                        @if(checkUserRole('birth.update'))
                                            <a href="#" class="btn btn-primary f-12" onclick="showData({{ $item }})"
                                               data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i>&nbsp;
                                                Edit</a>
                                        @endif
                                        @if(checkUserRole('birth.destroy'))
                                            <form id="delete-form-{{ $loop->index }}"
                                                  action="{{ route('birth.destroy', $item->id) }}"
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
                                            <a href="{{route('birth.pdf', $item->id)}}"
                                               class="btn btn-info btn-sm align-items-center"><i
                                                    class="fas fa-file-pdf"></i>&nbsp;PDF</a>
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
    <!-- End Birth Report List Model -->

    <!-- Start Add New Birth Report Model -->
    @include('birth.create')
    <!-- End Add New Birth Report Model -->

    <!-- Start Edit Birth Report Model -->
    @include('birth.edit')
    <!-- End Edit Birth Report Model -->

    <!-- Start Birth Info Model -->
    @include('birth.info')
    <!-- End Birth Info Model -->

@endsection
@push('customScripts')
    <script>
        $("input[name*='mother_name']").keyup(function () {
            let value_input = $("input[name*='mother_name']").val();

            let regexp = /[^a-zA-Z. ]/g;
            if (value_input.match(regexp)) {
                $("input[name*='mother_name']").val(value_input.replace(regexp, ''))
            }
        });
        $("input[name*='father_name']").keyup(function () {
            let value_input = $("input[name*='father_name']").val();

            let regexp = /[^a-zA-Z. ]/g;
            if (value_input.match(regexp)) {
                $("input[name*='father_name']").val(value_input.replace(regexp, ''))
            }
        });
        $("input[name*='weight']").keyup(function () {
            let value_input = $("input[name*='weight']").val();
            let regexp = /[^0-9.]/g;
            if (value_input.match(regexp)) {
                $("input[name*='weight']").val(value_input.replace(regexp, ''))
            }
        });

        // Script(For Create)
        $('#createForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '/birth/store',
                method: "POST",
                data: $(this).serialize(),
                beforeSend: function () {
                    $('#createBtn').attr('disabled', false);
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
                    }
                    if (errors.errors.hasOwnProperty("mother_name")) {
                        $("#mother_name_error").text(errors.errors.mother_name[0]);
                    }
                    if (errors.errors.hasOwnProperty("father_name")) {
                        $("#father_name_error").text(errors.errors.father_name[0]);
                    }
                    if (errors.errors.hasOwnProperty("phone_number")) {
                        $("#phone_number_error").text(errors.errors.phone_number[0]);
                    }
                    if (errors.errors.hasOwnProperty("weight")) {
                        $("#weight_error").text(errors.errors.weight[0]);
                    }
                    if (errors.errors.hasOwnProperty("gender")) {
                        $("#gender_error").text(errors.errors.gender[0]);
                    }
                    if (errors.errors.hasOwnProperty("address")) {
                        $("#address_error").text(errors.errors.address[0]);
                    }
                    if (errors.errors.hasOwnProperty("note")) {
                        $("#note_error").text(errors.errors.note[0]);
                    }
                    if (errors.errors.hasOwnProperty("date")) {
                        $("#date_error").text(errors.errors.date[0]);
                    }
                    if (errors.errors.hasOwnProperty("date")) {
                        $("#time_error").text(errors.errors.time[0]);
                    }
                    if (errors.errors.hasOwnProperty("patient_id")) {
                        $("#patient_id_error").text(errors.errors.patient_id[0]);
                    }
                    if (errors.errors.hasOwnProperty("doctor_id")) {
                        $("#doctor_id_error").text(errors.errors.doctor_id[0]);
                    }
                    if (errors.errors.hasOwnProperty("blood_group_id")) {
                        $("#blood_group_id_error").text(errors.errors.blood_group_id[0]);
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
            $("input[name*='name']").val(item.name);
            $("input[name*='mother_name']").val(item.mother_name);
            $("input[name*='father_name']").val(item.father_name);
            $("input[name*='phone_number']").val(item.phone_number);
            $("input[name*='weight']").val(item.weight);
            $("select[name*='gender']").val(item.gender);
            $("input[name*='date']").val(item.date);
            $("input[name*='time']").val(item.time);
            $("select[name*='blood_group_id']").val(item.blood_group_id);
            $("select[name*='doctor_id']").val(item.doctor_id);
            $("textarea[name*='address']").val(item.address);
            $("textarea[name*='note']").val(item.note);
            $('#gender').prepend($('<option>', {
                value: item.gender,
                text: item.gender
            }).attr({'selected': 'selected', 'hidden': 'hidden'}));
            $('#doctor_id').prepend($('<option>', {
                value: item.doctor_id,
                text: item.doctors.first_name +" "+ item.doctors.last_name
            }).attr({'selected': 'selected', 'hidden': 'hidden'}));

        }

        function show(item) {
            // console.log('Show');
            // console.log(item);
            // console.log(item.doctors);
            console.log(item)
            $("#show_name").text(item.name);
            $("#show_mother_name").text(item.mother_name);
            $("#show_father_name").text(item.father_name);
            $("#show_phone_number").text(item.phone_number);
            $("#show_weight").text(item.weight);
            $("#show_gender").text(item.gender);
            $("#show_date").text(item.date);
            $("#show_time").text(item.time);
            $("#show_doctor").text(item.doctors.first_name + " " + item.doctors.last_name);
            $("#show_address").text(item.address);
            $("#show_note").text(item.note);
            $("#show_blood_group_id").text(item.blood_groups.name);

        }

        // Script(For Update)
        $('#editForm').on('submit', function (e) {
            e.preventDefault();

            let id = $("input[name*='id']").val();
            let name = $("#name").val();
            let mother_name = $("#mother_name").val();
            let father_name = $("#father_name").val();
            let phone_number = $("#phone_number").val();
            let weight = $("#weight").val();
            let gender = $("#gender").val();
            let date = $("#date").val();
            let time = $("#time").val();
            let blood_group_id = $("#blood_group_id").val();
            let doctor_id = $("#doctor_id").val();
            let address = $("#address").val();
            let note = $("#note").val();
            $.ajax({
                url: '/birth/' + id + '/update',
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    name: name,
                    father_name: father_name,
                    mother_name: mother_name,
                    phone_number: phone_number,
                    weight: weight,
                    gender: gender,
                    date: date,
                    time: time,
                    blood_group_id: blood_group_id,
                    doctor_id: doctor_id,
                    note: note,
                    address: address
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
                    if (errors.errors.hasOwnProperty("name")) {
                        $("#update_name_error").text(errors.errors.name[0]);
                    }
                    if (errors.errors.hasOwnProperty("father_name")) {
                        $("#update_father_name_error").text(errors.errors.father_name[0]);
                    }
                    if (errors.errors.hasOwnProperty("mother_name")) {
                        $("#update_mother_name_error").text(errors.errors.mother_name[0]);
                    }
                    if (errors.errors.hasOwnProperty("phone_number")) {
                        $("#update_phone_number_error").text(errors.errors.phone_number[0]);
                    }
                    if (errors.errors.hasOwnProperty("weight")) {
                        $("#update_weight_error").text(errors.errors.weight[0]);
                    }
                    if (errors.errors.hasOwnProperty("gender")) {
                        $("#update_gender_error").text(errors.errors.gender[0]);
                    }
                    if (errors.errors.hasOwnProperty("note")) {
                        $("#update_note_error").text(errors.errors.note[0]);
                    }
                    if (errors.errors.hasOwnProperty("address")) {
                        $("#update_address_error").text(errors.errors.address[0]);
                    }
                    if (errors.errors.hasOwnProperty("date")) {
                        $("#update_date_error").text(errors.errors.date[0]);
                    }
                    if (errors.errors.hasOwnProperty("time")) {
                        $("#update_time_error").text(errors.errors.time[0]);
                    }
                    if (errors.errors.hasOwnProperty("doctor_id")) {
                        $("#update_doctor_id_error").text(errors.errors.doctor_id[0]);
                    }
                    if (errors.errors.hasOwnProperty("blood_group_id")) {
                        $("#update_blood_group_id_error").text(errors.errors.blood_group_id[0]);
                    }
                }
            })
        });

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
