@extends('layouts.master')
@section('content')
    <!-- Start Bed Type Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            <div id="success-msg" class="alert alert-success"></div>

            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center"> Bed Assign List</span>
                    @if(checkUserRole('bed.assign.store'))
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
                                <th>Patient</th>
                                <th>Bed ID</th>
                                <th>Allotted Time</th>
                                <th>Discharge Time</th>
                                @if(checkUserRole('action.bed.assign'))
                                    <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>
                                        <a href="{{route('patient.show', $item->patients->id)}}" type="button"
                                           class="text-info">{{ $item->patients->full_name }}</a>
                                    </td>
                                    <td>{{ $item->bedList->bed_number }}</td>
                                    <td>{{ normalDateFormat($item->start_date) }}</td>
                                    <td>
                                        @if($item->end_date != null)
                                            {{ normalDateFormat($item->end_date) }}
                                    @else()
                                        {{__('Not Released Yet')}}
                                    @endif
                                    </td>
                                    @if(checkUserRole('action.bed.assign'))
                                        <td>
                                            @if(checkUserRole('bed.assign.update'))
                                                <a href="#" class="btn btn-primary f-12" onclick="showData({{ $item }})"
                                                   data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i>&nbsp;
                                                    Edit</a>
                                            @endif
                                            @if(checkUserRole('bed.assign.destroy'))
                                                <form id="delete-form-{{ $loop->index }}"
                                                             action="{{ route('bed.assign.destroy', $item->id) }}"
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
    <!-- End Bed Model -->

    <!-- Start New Bed Model -->
    @include('bed.assign.create')
    <!-- End New Bed Type Model -->

    <!-- Start Edit Bed Type Model -->
    @include('bed.assign.edit')
    <!-- End Edit Bed Type Model -->
@endsection


@push('customScripts')
    <script>
        // $('#createFormBtn').click(function() {
        //     $('#bed_number_error').text('');
        //     $('#createBtn').attr('disabled', true);
        // });
        // Create Browser validation
        // $("input[name*='price']").keyup(function () {
        //     let value_input = $("input[name*='price']").val();
        //     let regexp = /[^0-9+]/g ;
        //     if (value_input.match(regexp)) {
        //         $("input[name*='price']").val(value_input.replace(regexp,''))
        //     }
        //     if (value_input.length < 3) {
        //         $("#price_error").text("Minimum 3 Character Required");
        //         $('#createBtn').attr('disabled', true);
        //         return;
        //     }
        //     $("#price_error").text('');
        //     $('#createBtn').attr('disabled', false);
        // });


        $("select[name*='bed_list_id']").attr('disabled', true);

        $("select[name*='bed_type_id']").on('change', function (e) {
            e.preventDefault();

            let bed_type_id = this.value;

            $.ajax({
                url: '/bed/assign/' + bed_type_id + '/beds',
                method: "GET",
                success: function (response) {
                    $("select[name*='bed_list_id']").empty();
                    if (response.length) {
                        $.each(response, function (index, value) {
                            $("select[name*='bed_list_id']").append($('<option>', {
                                value: value.id,
                                text: value.bed_number,
                            }));
                        })
                        $("select[name*='bed_list_id']").attr('disabled', false);
                    }
                    if (response != null && !response.length) {
                        $("select[name*='bed_list_id']").append($('<option>', {
                            text: 'No bed available',
                        }));
                        $("select[name*='bed_list_id']").attr('disabled', true);
                    }
                },
            })
        })


        // Script(For Create)
        $('#createForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '/bed/assign/store',
                method: "POST",
                data: $(this).serialize(),
                beforeSend: function () {
                    $('#createBtn').attr('disabled', true);
                },
                success: function (response) {
                    $("#success-msg").text(response);
                    $('#add').modal('hide');
                    // console.log(response)
                    setInterval('location.reload()', 1000);
                },
                error: function (xhr, status, error) {
                    let errors = JSON.parse(xhr.responseText);
                    if (!errors.hasOwnProperty("errors")) {
                        $("#error-msg").text(errors.message);
                        $('#createBtn').attr('disabled', true);
                        return;
                    }
                    if (errors.errors.hasOwnProperty("patient_id")) {
                        $("#patient_id_error").text(errors.errors.patient_id[0]);
                    }
                    if (errors.errors.hasOwnProperty("bed_list_id")) {
                        $("#bed_list_id_error").text(errors.errors.bed_list_id[0]);
                    }
                    if (errors.errors.hasOwnProperty("start_date")) {
                        $("#start_date_error").text(errors.errors.start_date[0]);
                    }
                    if (errors.errors.hasOwnProperty("end_date")) {
                        $("#end_date_error").text(errors.errors.end_date[0]);
                    }
                },
            })
        })


        // Script(To show Data)
        function showData(item) {
            console.log('Show Data')
            console.log(item),
            $("input[name*='id']").val(item.id);
            $("input[name*='start_date']").val(item.start_date);
            $("input[name*='end_date']").val(item.end_date);
            // $("select[name*='bed_type_id']").val(item.bed_list_id.bed_type_id);
            $('#patient_id').prepend($('<option>', {
                value: item.patient_id,
                text: item.patients.first_name + ' ' + item.patients.last_name,
            }).attr({'selected': 'selected', 'hidden': 'hidden'}));

            $('#bed_list_id').prepend($('<option>', {
                value: item.bed_list_id,
                text: item.bed_list.bed_number,
            }).attr({'selected': 'selected', 'hidden': 'hidden'}));

            $('#bed_type_id').prepend($('<option>', {
                value: item.bed_type_id,
                text: item.bed_list.bed_type.name,
            }).attr({'selected': 'selected', 'hidden': 'hidden'}));
            // console.log($("#bed_list_id").val())
        }


        // Script(For Update)
        $('#editForm').on('submit', function (e) {
            e.preventDefault();
            let id = $("input[name*='id']").val();
            let patient_id = $("#patient_id").val();
            let bed_list_id = $("#bed_list_id").val();
            let start_date = $("#start_date").val();
            let end_date = $("#end_date").val();

            $.ajax({
                url: '/bed/assign/' + id + '/update',
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    patient_id: patient_id,
                    bed_list_id: bed_list_id,
                    start_date: start_date,
                    end_date: end_date,
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
                    if (errors.errors.hasOwnProperty("patient_id")) {
                        $("#update_patient_id_error").text(errors.errors.patient_id[0]);
                    }
                    if (errors.errors.hasOwnProperty("bed_list_id")) {
                        $("#update_bed_list_id_error").text(errors.errors.bed_list_id[0]);
                    }

                    if (errors.errors.hasOwnProperty("start_date")) {
                        $("#update_start_date_error").text(errors.errors.start_date[0]);
                    }
                    if (errors.errors.hasOwnProperty("end_date")) {
                        $("#update_end_date_error").text(errors.errors.end_date[0]);
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
