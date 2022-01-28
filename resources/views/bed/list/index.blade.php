@extends('layouts.master')
@section('content')
    <!-- Start Bed List Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            <div id="success-msg" class="alert alert-success"></div>

            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center"> Bed List</span>
                    @if(checkUserRole('bed.list.store'))
                        <a href="#" id="createFormBtn" class="btn btn-light" data-toggle="modal" data-target="#add"><i
                                class="fas fa-plus-circle"></i>&nbsp; Add</a>
                    @endif
                </h4>
                <div class="card-body f-14">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Bed ID</th>
                                <th>Bed Type</th>
                                <th>Floor</th>
                                <th>Description</th>
                                <th>Charge</th>
                                <th>Available</th>
                                <th>Status</th>
                                @if(checkUserRole('action.bed.list'))
                                    <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{$item->bed_number}}</td>
                                    <td>{{$item->bedType->name}}</td>
                                    <td>{{$item->floor}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>
                                        @include('layouts.partials.is_available', ['is_available' => $item->is_available])
                                    </td>
                                    <td>
                                        @include('layouts.partials.status', ['status' => $item->status ])
                                    </td>
                                    @if(checkUserRole('action.bed.list'))
                                        <td>
                                            @if(checkUserRole('bed.list.update'))
                                                <button value="{{ $item->id }}" class="btn btn-primary f-12"
                                                        onclick="showBedInformation(this)"
                                                        data-toggle="modal" data-target="#edit"><i
                                                        class="fas fa-edit"></i>&nbsp;
                                                </button>
                                            @endif
                                            @if(checkUserRole('bed.list.destroy'))
                                                <form id="delete-form-{{ $loop->index }}"
                                                      action="{{ route('bed.list.destroy', $item->id) }}"
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
    <!-- End Bed List Model -->

    <!-- Start Add New Bed Model -->
    @include('bed.list.create')
    <!-- End Add New Bed Model -->

    <!-- Start Edit Bed Model -->
    @include('bed.list.edit')
    <!-- End Edit Bed Model -->
@endsection


@push('customScripts')
    <script>
        // Create Browser validation
        $("input[name*='price']").keyup(function () {
            let value_input = $("input[name*='price']").val();
            let regexp = /[^0-9+]/g;
            if (value_input.match(regexp)) {
                $("input[name*='price']").val(value_input.replace(regexp, ''))
            }
        });


        // Script(To show Data)
        // function showData(item) {
        //     $("input[name*='id']").val(item.id);
        //     $("input[name*='bed_number']").val(item.bed_number);
        //     $("input[name*='floor']").val(item.floor);
        //     $("input[name*='description']").val(item.description);
        //     $("input[name*='price']").val(item.price);
        //
        //     $('#is_available').prepend($('<option>', {
        //         value: item.is_available,
        //         text: item.is_available === 1 ? 'Available' : 'Not Available'
        //     }).attr({'selected': 'selected', 'hidden': 'hidden'}));
        //
        //     $('#status').prepend($('<option>', {
        //         value: item.status,
        //         text: item.status === 1 ? 'Active' : 'Inactive'
        //     }).attr({'selected': 'selected', 'hidden': 'hidden'}));
        //
        //     $('#bed_type_id').prepend($('<option>', {
        //         value: item.bed_type_id,
        //         text: item.bed_type.name,
        //     }).attr({'selected': 'selected', 'hidden': 'hidden'}));
        // }

        // Script(For Create)
        $('#createForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '/bed/list/store',
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
                    if (!errors.hasOwnProperty("errors")) {
                        $("#error-msg").text(errors.message);
                        $('#createBtn').attr('disabled', true);
                        return;
                    }
                    if (errors.errors.hasOwnProperty("bed_number")) {
                        $("#bed_number_error").text(errors.errors.bed_number[0]);
                    }
                    if (errors.errors.hasOwnProperty("bed_type_id")) {
                        $("#bed_type_id_error").text(errors.errors.bed_type_id[0]);
                    }
                    if (errors.errors.hasOwnProperty("floor")) {
                        $("#floor_error").text(errors.errors.floor[0]);
                    }
                    if (errors.errors.hasOwnProperty("price")) {
                        $("#price_error").text(errors.errors.price[0]);
                    }
                    if (errors.errors.hasOwnProperty("is_available")) {
                        $("#is_available_error").text(errors.errors.is_available[0]);
                    }
                    if (errors.errors.hasOwnProperty("status")) {
                        $("#status_error").text(errors.errors.status[0]);
                    }
                },
            })
        })
        // Script(For Update)
        $('#editForm').on('submit', function (e) {
            e.preventDefault();
            let id = $("input[name*='id']").val();
            let bed_number = $("#bed_number").val();
            let bed_type_id = $("#bed_type_id").val();
            let floor = $("#floor").val();
            let description = $("#description").val();
            let price = $("#price").val();
            let is_available = $("#is_available").val();
            let status = $("#status").val();

            $.ajax({
                url: '/bed/list/' + id + '/update',
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    bed_number: bed_number,
                    bed_type_id: bed_type_id,
                    floor: floor,
                    description: description,
                    price: price,
                    is_available: is_available,
                    status: status
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
                    if (errors.errors.hasOwnProperty("bed_number")) {
                        $("#update_bed_number_error").text(errors.errors.bed_number[0]);
                    }
                    if (errors.errors.hasOwnProperty("bed_type_id")) {
                        $("#update_bed_type_id_error").text(errors.errors.bed_type_id[0]);
                    }
                    if (errors.errors.hasOwnProperty("floor")) {
                        $("#update_floor_error").text(errors.errors.floor[0]);
                    }
                    if (errors.errors.hasOwnProperty("price")) {
                        $("#update_price_error").text(errors.errors.price[0]);
                    }
                    if (errors.errors.hasOwnProperty("is_available")) {
                        $("#update_is_available_error").text(errors.errors.is_available[0]);
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


        function showBedInformation(e) {
            $.ajax({
                url: '/bed/list/' + $(e).val(),
                method: "GET",
                success: function (response) {
                    console.log(response)
                    $("input[name*='id']").val(response.id);
                    $("input[name*='bed_number']").val(response.bed_number);
                    $("input[name*='floor']").val(response.floor);
                    $("input[name*='description']").val(response.description);
                    $("input[name*='price']").val(response.price);
                    // $('#bed_type_id').append($('<option>', {
                    //     value: response.bed_type_id,
                    //     text: response.bed_type.name,
                    // }).attr({'selected': 'selected', 'hidden': 'hidden'}));
                    $("#bed_type_id").attr("width","500");
                    // $('#is_available').append(response.is_available)
                    {{--@@if()--}}
                    {{--document.getElementById('is_available').setAttribute('selected', 'selected')--}}

                }
            })
        }

        // $("#open-modal").on('click', function (e) {
        //     console.log($(e))
        //
        // })

    </script>
@endpush
