@extends('layouts.master')
@section('content')
    <!-- Start Ambulance Service Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            <div id="success-msg" class="alert alert-success"></div>

            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Ambulance List</span>
                    @if(checkUserRole('ambulance.store'))
                        <a href="#" id="createFormBtn" class="btn btn-light" data-toggle="modal" data-target="#add"><i
                                class="fas fa-plus-circle"></i>&nbsp; Add</a>
                    @endif
                </h4>
                <div class="card-body f-14">
                    <div class="table-responsive" id="showAmbulance">
                        <table class="table table-striped text-canter">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Vehicle Number</th>
                                <th>Vehicle Model</th>
                                <th>Driver Name</th>
                                <th>Driver Contact</th>
                                <th>Driver License</th>
                                <th>Address</th>
                                @if(checkUserRole('action.ambulance'))
                                    <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{$item->vehicle_number}}</td>
                                    <td>{{$item->vehicle_model}}</td>
                                    <td>{{$item->driver_name}}</td>
                                    <td>{{$item->driver_phone_number}}</td>
                                    <td>{{$item->driver_license}}</td>
                                    <td>{{$item->driver_address}}</td>
                                    @if(checkUserRole('action.ambulance'))
                                        <td>
                                            @if(checkUserRole('ambulance.update'))
                                                <a href="#" class="btn btn-primary f-12" onclick="showData({{ $item }})"
                                                   data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i>&nbsp;
                                                    Edit</a>
                                            @endif

                                            @if(checkUserRole('ambulance.destroy'))
                                                <form id="delete-form-{{ $loop->index }}"
                                                      action="{{ route('ambulance.destroy', $item->id) }}"
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
    <!-- End Ambulance Service Model -->
    <!-- Start Add Ambulance Model -->
    @include('ambulance.create')
    <!-- End Add Ambulance Model -->
    <!-- Start Edit Ambulance Model -->
    @include('ambulance.edit')
    <!-- End Edit Ambulance Model -->
@endsection
@push('customScripts')
    <script>
        // $('#createFormBtn').click(function () {
        //     $('#name_error').text('');
        //     $('#createBtn').attr('disabled', true);
        // });
        // Create Browser validation
        // $("input[name*='driver_name']").keyup(function () {
        //     let value_input = $("input[name*='driver_name']").val();
        //     let regexp = /[^a-zA-Z. ]/g;
        //     if (value_input.match(regexp)) {
        //         $("input[name*='driver_name']").val(value_input.replace(regexp, ''))
        //     }
        //     if (value_input.length < 3) {
        //         $("#driver_name_error").text("Minimum 3 Character Required");
        //         $('#createBtn').attr('disabled', true);
        //         return;
        //     }
        //     $("#driver_name_error").text('');
        //     $('#createBtn').attr('disabled', false);
        // });
        //
        // $("input[name*='driver_phone_number']").keyup(function () {
        //     let value_input = $("input[name*='driver_phone_number']").val();
        //     let regexp = /[^0-9+]/g;
        //     if (value_input.match(regexp)) {
        //         $("input[name*='driver_phone_number']").val(value_input.replace(regexp, ''))
        //     }
        //     if (value_input.length < 11) {
        //         $("#name_error").text("Minimum 11 Character Required");
        //         $('#createBtn').attr('disabled', true);
        //         return;
        //     }
        //     $("#driver_phone_number_error").text('');
        //     $('#createBtn').attr('disabled', false);
        // });


        // Script(For Create)
        $('#createForm').on('submit', function (e) {
            e.preventDefault();
            console.log('submit')
            $.ajax({
                url: '/ambulance/store',
                method: "POST",
                data: $(this).serialize(),
                beforeSend: function () {
                    $('#createBtn').attr('disabled', false);
                },
                success: function (response) {
                    console.log('success response')
                    console.log(response)
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
                    if (errors.errors.hasOwnProperty("vehicle_number")) {
                        $("#vehicle_number_error").text(errors.errors.vehicle_number[0]);
                    }
                    if (errors.errors.hasOwnProperty("vehicle_model")) {
                        $("#model_error").text(errors.errors.vehicle_model[0]);
                    }
                    if (errors.errors.hasOwnProperty("driver_name")) {
                        $("#driver_name_error").text(errors.errors.driver_name[0]);
                    }
                    if (errors.errors.hasOwnProperty("driver_license")) {
                        $("#license_error").text(errors.errors.driver_license[0]);
                    }
                    if (errors.errors.hasOwnProperty("driver_phone_number")) {
                        $("#driver_number_error").text(errors.errors.driver_phone_number[0]);
                    }
                    if (errors.errors.hasOwnProperty("driver_address")) {
                        $("#driver_address_error").text(errors.errors.driver_address[0]);
                    }
                },
            })
        })


        // Script(To show Data)
        function showData(item) {
            $("input[name*='id']").val(item.id);
            $("input[name*='vehicle_number']").val(item.vehicle_number);
            $("input[name*='vehicle_model']").val(item.vehicle_model);
            $("input[name*='driver_name']").val(item.driver_name);
            $("input[name*='driver_license']").val(item.driver_license);
            $("input[name*='driver_phone_number']").val(item.driver_phone_number);
            $("input[name*='driver_address']").val(item.driver_address);
        }


        // Script(For Update)
        $('#editForm').on('submit', function (e) {
            e.preventDefault();
            let id = $("input[name*='id']").val();
            let vehicle_number = $("#vehicle_number").val();
            let vehicle_model = $("#vehicle_model").val();
            let driver_name = $("#driver_name").val();
            let driver_license = $("#driver_license").val();
            let driver_phone_number = $("#driver_phone_number").val();
            let driver_address = $("#driver_address").val();
            $.ajax({
                url: '/ambulance/' + id + '/update',
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    vehicle_number: vehicle_number,
                    vehicle_model: vehicle_model,
                    driver_name: driver_name,
                    driver_license: driver_license,
                    driver_phone_number: driver_phone_number,
                    driver_address: driver_address
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
                    if (errors.errors.hasOwnProperty("vehicle_number")) {
                        $("#update_vehicle_number_error").text(errors.errors.vehicle_number[0]);
                    }
                    if (errors.errors.hasOwnProperty("vehicle_model")) {
                        $("#update_model_error").text(errors.errors.vehicle_model[0]);
                    }
                    if (errors.errors.hasOwnProperty("driver_name")) {
                        $("#update_driver_name_error").text(errors.errors.driver_name[0]);
                    }
                    if (errors.errors.hasOwnProperty("driver_license")) {
                        $("#update_license_error").text(errors.errors.driver_license[0]);
                    }
                    if (errors.errors.hasOwnProperty("driver_phone_number")) {
                        $("#update_driver_number_error").text(errors.errors.driver_phone_number[0]);
                    }
                    if (errors.errors.hasOwnProperty("driver_address")) {
                        $("#update_driver_address_error").text(errors.errors.driver_address[0]);
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
