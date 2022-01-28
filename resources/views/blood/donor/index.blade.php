@extends('layouts.master')
@section('content')

    <!-- Start Blood Donor Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            <div id="success-msg" class="alert alert-success"></div>


            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Blood Donor List</span>
                    {{--                <a href="#" id="createFormBtn" class="btn btn-light" data-toggle="modal" data-target="#addDonor"><i class="fas fa-plus-circle"></i>&nbsp; ADD</a>--}}
                </h4>


                <div class="card-body f-12">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter">
                            <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Blood Group</th>
                                <th>Phone</th>
                                <th>Address</th>
                                @if(checkUserRole('action.blood.donor'))
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
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ ucwords($item->bloodGroup->name)}}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ ucwords($item->address)}}</td>
                                    @if(checkUserRole('action.blood.donor'))
                                        <td>
                                            @if(checkUserRole('blood.donor.update'))
                                                <a href="#" class="btn btn-primary f-12" onclick="showData({{ $item }})"
                                                   data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i>&nbsp;
                                                    Edit</a>
                                            @endif
                                            @if(checkUserRole('blood.donor.destroy'))
                                                <form id="delete-form-{{ $loop->index }}"
                                                      action="{{ route('blood.donor.destroy', $item->id) }}"
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
    <!-- End Blood Donor List Model -->


    <!-- Start New Blood Donor Model -->
    {{--    @include('blood.donor.create')--}}
    <!-- End New Blood Donor Model -->

    <!-- Start Edit Blood Donor Model -->
    @include('blood.donor.edit')
    <!-- End Edit Blood Donor Model -->

@endsection

@push('customScripts')
    <script>
        // Script(To show Data)
        function showData(item) {
            console.log(item.blood_collection)

            $("input[name*='id']").val(item.id);
            $("input[name*='first_name']").val(item.first_name);
            $("input[name*='last_name']").val(item.last_name);
            $("input[name*='age']").val(item.age);
            $("input[name*='phone_number']").val(item.phone_number);
            $("textarea[name*='address']").val(item.address);
            $("select[name*='blood_group_id']").val(item.blood_group_id);
            $('#gender').prepend($('<option>', {
                value: item.gender,
                text: item.gender
            }).attr({'selected': 'selected', 'hidden': 'hidden'}));
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
                let blood_group_id = $("#blood_group_id").val();
                $.ajax({
                    url: '/blood/donor/' + id + '/update',
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
                        blood_group_id: blood_group_id,
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
                        if (errors.errors.hasOwnProperty("address")) {
                            $("#update_address_error").text(errors.errors.address[0]);
                        }
                        if (errors.errors.hasOwnProperty("blood_group_id")) {
                            $("#update_blood_group_id_error").text(errors.errors.blood_group_id[0]);
                        }
                    }
                })
            })
        }

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
