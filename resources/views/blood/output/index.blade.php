@extends('layouts.master')
@section('content')

    <!-- Start Blood Output Status Model -->
    <div class="row justify-content-center">
        <div class="col-sm-12 m-3">
            <div id="success-msg" class="alert alert-success"></div>

            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Blood Bank Status</span>
                </h4>
                <div class="card-body f-14">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter" border=".5">
                            <thead class="bg-warning">
                            <tr>
                                <th>Status</th>
                                <th>A+</th>
                                <th>A-</th>
                                <th>B+</th>
                                <th>B-</th>
                                <th>O+</th>
                                <th>O-</th>
                                <th>AB+</th>
                                <th>AB-</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Available</td>
                                <td>{{ $bloodCollection['available'][1] ?? 0 }}</td>
                                <td>{{ $bloodCollection['available'][2] ?? 0 }}</td>
                                <td>{{ $bloodCollection['available'][3] ?? 0 }}</td>
                                <td>{{ $bloodCollection['available'][4] ?? 0 }}</td>
                                <td>{{ $bloodCollection['available'][5] ?? 0 }}</td>
                                <td>{{ $bloodCollection['available'][6] ?? 0 }}</td>
                                <td>{{ $bloodCollection['available'][7] ?? 0 }}</td>
                                <td>{{ $bloodCollection['available'][8] ?? 0 }}</td>

                            </tr>
                            <tr>
                                <td>Out</td>
                                <td>{{ $bloodCollection['unavailable'][1] ?? 0 }}</td>
                                <td>{{ $bloodCollection['unavailable'][2] ?? 0 }}</td>
                                <td>{{ $bloodCollection['unavailable'][3] ?? 0 }}</td>
                                <td>{{ $bloodCollection['unavailable'][4] ?? 0 }}</td>
                                <td>{{ $bloodCollection['unavailable'][5] ?? 0 }}</td>
                                <td>{{ $bloodCollection['unavailable'][6] ?? 0 }}</td>
                                <td>{{ $bloodCollection['unavailable'][7] ?? 0 }}</td>
                                <td>{{ $bloodCollection['unavailable'][8] ?? 0 }}</td>
                            </tr>
                            {{--                            <tr>--}}
                            {{--                                <td>Total</td>--}}
                            {{--                                <td>15</td>--}}
                            {{--                                <td>15</td>--}}
                            {{--                                <td>15</td>--}}
                            {{--                                <td>15</td>--}}
                            {{--                                <td>15</td>--}}
                            {{--                                <td>15</td>--}}
                            {{--                                <td>15</td>--}}
                            {{--                                <td>15</td>--}}
                            {{--                            </tr>--}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Output Blood List</span>
                    @if(checkUserRole('blood.output.store'))
                        <a href="#" id="createFormBtn" class="btn btn-light" data-toggle="modal" data-target="#add"><i
                                class="fas fa-plus-circle"></i>&nbsp; ADD</a>
                    @endif
                </h4>
                <div class="card-body f-13">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter table-col-bar">
                            <thead class="bg-secondary">
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Blood Group</th>
                                <th>Date</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Bag Number</th>
                                @if(checkUserRole('action.blood.output'))
                                    <th width="200px">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ ucwords($item->name) }}</td>
                                    <td>{{ ucwords($item->bloodGroup->name)}}</td>
                                    <td>{{ normalDateFormat($item->date)}}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ ucwords($item->address)}}</td>
                                    <td>
                                        @foreach($item->bloodCollection as $itemCollection)
                                            {{ $itemCollection->bag_number}}
                                        @endforeach
                                    </td>
                                    @if(checkUserRole('action.blood.output'))
                                        <td>
                                            @if(checkUserRole('blood.output.update'))
                                                <a href="#" class="btn btn-primary f-12" onclick="showData({{ $item }})"
                                                   data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i>&nbsp;
                                                    Edit</a>
                                            @endif
                                            @if(checkUserRole('blood.output.destroy'))
                                                <form id="delete-form-{{ $loop->index }}"
                                                      action="{{ route('blood.output.destroy', $item->id) }}"
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- End Blood Output Status Model -->

    <!-- Start Create Blood Input Status Model -->
    @include('blood.output.create')
    <!-- End Create Blood Input Status Model -->

    <!-- Start Edit Blood Input Status Model -->
    @include('blood.output.edit')
    <!-- End Edit Blood Input Status Model -->
@endsection
@push('customScripts')
    <script>
        $("select[name*='blood_collection_id']").attr('disabled', true);

        $("select[name*='blood_group_id']").on('change', function (e) {
            e.preventDefault();

            let blood_group_id = this.value;

            $.ajax({
                url: '/blood/output/' + blood_group_id + '/bags',
                method: "GET",
                success: function (response) {
                    $("select[name*='blood_collection_id']").empty();
                    if (response.length) {
                        $.each(response, function (index, value) {
                            $("select[name*='blood_collection_id']").append($('<option>', {
                                value: value.id,
                                text: value.bag_number,
                            }));
                        })
                        $("select[name*='blood_collection_id']").attr('disabled', false);
                    }
                    if (response != null && !response.length) {
                        $("select[name*='blood_collection_id']").append($('<option>', {
                            text: 'No bag available',
                        }));
                        $("select[name*='blood_collection_id']").attr('disabled', true);
                    }
                },
            })
        })


        // Script(For Create)
        $('#createForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '/blood/output/store',
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
                    if (errors.errors.hasOwnProperty("name")) {
                        $("#name_error").text(errors.errors.name[0]);
                    }
                    if (errors.errors.hasOwnProperty("phone_number")) {
                        $("#phone_number_error").text(errors.errors.phone_number[0]);
                    }
                    if (errors.errors.hasOwnProperty("date")) {
                        $("#date_error").text(errors.errors.date[0]);
                    }
                    if (errors.errors.hasOwnProperty("address")) {
                        $("#address_error").text(errors.errors.address[0]);
                    }
                    if (errors.errors.hasOwnProperty("is_patient")) {
                        $("#is_patient_error").text(errors.errors.is_patient[0]);
                    }
                    if (errors.errors.hasOwnProperty("blood_group_id")) {
                        $("#blood_group_id_error").text(errors.errors.blood_group_id[0]);
                    }
                    if (errors.errors.hasOwnProperty("blood_collection_id")) {
                        $("#blood_collection_error").text(errors.errors.blood_collection_id[0]);
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
            // console.log(item.blood_collection)

            $("input[name*='id']").val(item.id);
            $("input[name*='name']").val(item.name);
            $("input[name*='phone_number']").val(item.phone_number);
            $("textarea[name*='address']").val(item.address);
            $("input[name*='date']").val(item.date);
            // $("input[name*='bag_number']").val(item.blood_collection[0].bag_number);
            $("select[name*='blood_group_id']").val(item.blood_group_id);
            // $("select[name*='blood_collection_id']").val(item.blood_collection_id);

            $('#is_patient').prepend($('<option>', {
                value: item.is_patient,
                text: item.is_patient === 1 ? 'Yes' : 'No'
            }).attr({'selected': 'selected', 'hidden': 'hidden'}));

            $('#blood_collection_id').prepend($('<option>', {
                value: item.blood_collection_id,
                text: item.blood_collection[0].bag_number
            }).attr({'selected': 'selected', 'hidden': 'hidden'}));

        }

        // Script(For Update)
        $('#editForm').on('submit', function (e) {
            e.preventDefault();

            let id = $("input[name*='id']").val();
            let name = $("#name").val();
            let phone_number = $("#phone_number").val();
            let address = $("#address").val();
            let date = $("#date").val();
            let is_patient = $("#is_patient").val();
            let blood_group_id = $("#blood_group_id").val();
            let blood_collection_id = $("#blood_collection_id").val();
            console.log(blood_collection_id)
            $.ajax({
                url: '/blood/output/' + id + '/update',
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    name: name,
                    phone_number: phone_number,
                    address: address,
                    date: date,
                    is_patient: is_patient,
                    blood_group_id: blood_group_id,
                    blood_collection_id: blood_collection_id,
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
                    if (errors.errors.hasOwnProperty("phone_number")) {
                        $("#update_phone_number_error").text(errors.errors.phone_number[0]);
                    }
                    if (errors.errors.hasOwnProperty("date")) {
                        $("#update_date_error").text(errors.errors.date[0]);
                    }
                    if (errors.errors.hasOwnProperty("address")) {
                        $("#update_address_error").text(errors.errors.address[0]);
                    }
                    if (errors.errors.hasOwnProperty("is_patient")) {
                        $("#update_is_patient_error").text(errors.errors.is_patient[0]);
                    }
                    if (errors.errors.hasOwnProperty("blood_group_id")) {
                        $("#update_blood_group_id_error").text(errors.errors.blood_group_id[0]);
                    }
                    if (errors.errors.hasOwnProperty("blood_collection_id")) {
                        $("#update_blood_collection_id").text(errors.errors.blood_collection_id[0]);
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
