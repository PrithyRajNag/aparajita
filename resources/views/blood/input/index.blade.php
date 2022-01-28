@extends('layouts.master')
@section('content')
    <!-- Start Blood Input Status Model -->
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Input Blood List</span>
                    @if(checkUserRole('blood.input.store'))
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
                                <th>Age</th>
                                <th>Blood Group</th>
                                <th>Date</th>
                                <th>Phone</th>
                                <th>Bag Number</th>
                                @if(checkUserRole('action.blood.input'))
                                    <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ ucwords($item->full_name) }}</td>
                                    <td>{{ $item->age }}</td>
                                    <td>{{ ucwords($item->bloodGroup->name)}}</td>
                                    <td>{{ normalDateFormat($item->date)}}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>
                                        @foreach($item->bloodCollection as $itemCollection)
                                            @if($itemCollection->is_available)
                                                {{ $itemCollection->bag_number }},
                                            @endif
                                        @endforeach
                                    </td>
                                    @if(checkUserRole('action.blood.input'))
                                        <td>
                                            @if(checkUserRole('blood.input.update'))
                                                <a href="" class="btn btn-primary f-12" onclick="showData({{ $item }})"
                                                   data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i>&nbsp;
                                                    Edit</a>
                                            @endif
                                            @if(checkUserRole('blood.input.destroy'))
                                                <form id="delete-form-{{ $loop->index }}"
                                                      action="{{ route('blood.input.destroy', $item->id) }}"
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
    </div>
    <!-- End Blood Input Status Model -->

    <!-- Start Create Blood Input Status Model -->
    @include('blood.input.create')
    <!-- End Create Blood Input Status Model -->

    <!-- Start Edit Blood Input Status Model -->
    @include('blood.input.edit')
    <!-- End Edit Blood Input Status Model -->
@endsection
@push('customScripts')
    <script>
        // Script(For Create)
        $('#createForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '/blood/input/store',
                method: "POST",
                data: $(this).serialize(),
                beforeSend: function () {
                    $('#createBtn').attr('disabled', true);
                },
                error: function (xhr, status, error) {
                    let errors = JSON.parse(xhr.responseText);
                    if (!errors.hasOwnProperty("errors")) {
                        $("#error-msg").text(errors.message);
                        return;
                    }
                    if (errors.errors.hasOwnProperty("first_name")) {
                        $("#first_name_error").text(errors.errors.first_name[0]);
                    }
                    if (errors.errors.hasOwnProperty("last_name")) {
                        $("#last_name_error").text(errors.errors.last_name[0]);
                    }
                    if (errors.errors.hasOwnProperty("phone_number")) {
                        $("#phone_number_error").text(errors.errors.phone_number[0]);
                    }
                    if (errors.errors.hasOwnProperty("gender")) {
                        $("#gender_error").text(errors.errors.gender[0]);
                    }
                    if (errors.errors.hasOwnProperty("age")) {
                        $("#age_error").text(errors.errors.age[0]);
                    }
                    if (errors.errors.hasOwnProperty("date")) {
                        $("#date_error").text(errors.errors.date[0]);
                    }
                    if (errors.errors.hasOwnProperty("address")) {
                        $("#address_error").text(errors.errors.address[0]);
                    }
                    if (errors.errors.hasOwnProperty("bag_number")) {
                        $("#bag_number_error").text(errors.errors.bag_number[0]);
                    }
                    if (errors.errors.hasOwnProperty("is_regular_donor")) {
                        $("#is_regular_donor_error").text(errors.errors.is_regular_donor[0]);
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
            console.log(item.blood_collection)

            $("input[name*='id']").val(item.id);
            $("input[name*='first_name']").val(item.first_name);
            $("input[name*='last_name']").val(item.last_name);
            $("input[name*='age']").val(item.age);
            $("input[name*='phone_number']").val(item.phone_number);
            $("textarea[name*='address']").val(item.address);
            $("input[name*='date']").val(item.date);
            $("input[name*='bag_number']").val(item.blood_collection[0].bag_number);
            $("select[name*='blood_group_id']").val(item.blood_group_id);
            $('#gender').prepend($('<option>', {
                value: item.gender,
                text: item.gender
            }).attr({'selected': 'selected', 'hidden': 'hidden'}));
            $('#is_regular_donor').prepend($('<option>', {
                value: item.is_regular_donor,
                text: item.is_regular_donor === 1 ? 'Yes' : 'No'
            }).attr({'selected': 'selected', 'hidden': 'hidden'}));
            $('#is_available').prepend($('<option>', {
                value: item.is_available,
                text: item.is_available === 1 ? 'Available' : 'Not Available'
            }).attr({'selected': 'selected', 'hidden': 'hidden'}));

        }

        // Script(For Update)
        $('#editForm').on('submit', function (e) {
            e.preventDefault();

            let id = $("input[name*='id']").val();
            let first_name = $("#first_name").val();
            let last_name = $("#last_name").val();
            let age = $("#age").val();
            let phone_number = $("#phone_number").val();
            let address = $("#address").val();
            let gender = $("#gender").val();
            let date = $("#date").val();
            let bag_number = $("#bag_number").val();
            let blood_group_id = $("#blood_group_id").val();
            let is_regular_donor = $("#is_regular_donor").val();
            $.ajax({
                url: '/blood/input/' + id + '/update',
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    first_name: first_name,
                    last_name: last_name,
                    age: age,
                    phone_number: phone_number,
                    address: address,
                    gender: gender,
                    date: date,
                    bag_number: bag_number,
                    blood_group_id: blood_group_id,
                    is_regular_donor: is_regular_donor,
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
                        return;
                    }
                    if (errors.errors.hasOwnProperty("first_name")) {
                        $("#update_first_name_error").text(errors.errors.first_name[0]);
                    }
                    if (errors.errors.hasOwnProperty("last_name")) {
                        $("#update_last_name_error").text(errors.errors.last_name[0]);
                    }
                    if (errors.errors.hasOwnProperty("phone_number")) {
                        $("#update_phone_number_error").text(errors.errors.phone_number[0]);
                    }
                    if (errors.errors.hasOwnProperty("gender")) {
                        $("#update_gender_error").text(errors.errors.gender[0]);
                    }
                    if (errors.errors.hasOwnProperty("age")) {
                        $("#update_age_error").text(errors.errors.age[0]);
                    }
                    if (errors.errors.hasOwnProperty("date")) {
                        $("#update_date_error").text(errors.errors.date[0]);
                    }
                    if (errors.errors.hasOwnProperty("address")) {
                        $("#update_address_error").text(errors.errors.address[0]);
                    }
                    if (errors.errors.hasOwnProperty("bag_number")) {
                        $("#update_bag_number_error").text(errors.errors.bag_number[0]);
                    }
                    if (errors.errors.hasOwnProperty("is_regular_donor")) {
                        $("#update_is_regular_donor_error").text(errors.errors.is_regular_donor[0]);
                    }
                    if (errors.errors.hasOwnProperty("blood_group_id")) {
                        $("#update_blood_group_id_error").text(errors.errors.blood_group_id[0]);
                    }
                    if (errors.errors.hasOwnProperty("is_available")) {
                        $("#is_available_error").text(errors.errors.is_available[0]);
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

