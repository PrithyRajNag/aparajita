@extends('layouts.master')
@section('content')
    <!-- Start Test Result Item Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
{{--            @if(session('success'))--}}
{{--                <div class="alert alert-success">--}}
{{--                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span--}}
{{--                            aria-hidden="true">&times;</span></button>--}}
{{--                    {{ session('success') }}--}}
{{--                </div>--}}
{{--            @endif--}}
            <div id="success-msg" class="alert alert-success"></div>

            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Test Result Item</span>
{{--                    @if(checkUserRole('test.category.store'))--}}
                        <a href="#" class="btn btn-light" data-toggle="modal" data-target="#add"><i
                                class="fas fa-plus-circle"></i>&nbsp; ADD</a>
{{--                    @endif--}}
                </h4>
                <div class="card-body f-13">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter table-col-bar">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Result Item Name</th>
                                <th>Result Category Name</th>
                                <th>Normal Range</th>
                                <th>Unit</th>
{{--                                @if(checkUserRole('action.test.index'))--}}
                                    <th>Action</th>
{{--                                @endif--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ucwords($item->name)}}</td>
                                    <td>{{$item->testResultCategory->name}}</td>
                                    <td>{{$item->normal_range}}</td>
                                    <td>{{$item->unit}}</td>
{{--                                    @if(checkUserRole('action.test.index'))--}}
                                        <td>
{{--                                            @if(checkUserRole('test.update'))--}}
                                                <a href="#" class="btn btn-primary f-12" onclick="showData({{ $item }})"
                                                   data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i>&nbsp;
                                                    Edit</a>
{{--                                            @endif--}}
{{--                                            @if(checkUserRole('test.destroy'))--}}
                                                <form id="delete-form-{{ $loop->index }}"
                                                      action="{{ route('test.result.item.destroy', $item->id) }}"
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
{{--                                            @endif--}}
                                        </td>
{{--                                    @endif--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Test Result Item List Model -->

    <!-- Start Add New Test Result Item Model -->
    @include('test.result.item.create')
    <!-- End Add New Test Result Item Model -->

    <!-- Start Edit Test Result Item Model -->
    @include('test.result.item.edit')
    <!-- End Edit Test Result Item Model -->
@endsection

@push('customScripts')
    <script>

        $('#createFormBtn').click(function () {
            $('#name_error').text('');
            $('#normal_range_error').text('');
            $('#unit_error').text('');
            $('#test_result_category_id_error').select();

            $('#createBtn').attr('disabled', false);
        });

        // Browser validation
        $("input[name*='name']").keyup(function () {
            let value_input = $("input[name*='name']").val();

            let regexp = /[^a-zA-Z. ]/g;
            if (value_input.match(regexp)) {
                $("input[name*='name']").val(value_input.replace(regexp, ''))
            }

            if (value_input.length < 3) {
                $("#name_error").text("Minimum 3 Character Required");
                $('#createBtn').attr('disabled', true);
                return;
            }
            $("#name_error").text('');
            $('#createBtn').attr('disabled', false);
        });


        // Script(To show Data)
        function showData(item) {

            $("input[name*='id']").val(item.id);
            $("input[name*='name']").val(item.name);
            $("select[name*='test_result_category_id']").val(item.test_result_category_id);
            $("input[name*='normal_range']").val(item.normal_range);
            $("input[name*='unit']").val(item.unit);
        }

        // Script(For Create)
        $('#createForm').on('submit', function (e) {
            e.preventDefault();
            console.log("#createBtn");
            $.ajax({
                url: '/test/result/item/store',
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
                    let errorName = errors.errors.name[0];
                    $("#name_error").text(errorName);
                    $("#unit_error").text(errorName);
                    $("#normal_range_error").text(errorName);
                    $("#test_result_category_id_error").text(errorName);
                },

            })
        })


        // Script(For Update)
        $('#editForm').on('submit', function (e) {
            e.preventDefault();
            console.log('Inserted');
            let id = $("input[name*='id']").val();
            let name = $("#name").val();
            let normal_range = $("#normal_range").val();
            let unit = $("#unit").val();
            let test_result_category_id = $("#test_result_category_id").val();
            $.ajax({
                url: '/test/result/item/' + id + '/update',
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name,
                    normal_range: normal_range,
                    unit: unit,
                    test_result_category_id: test_result_category_id,
                },
                success: function (response) {
                    if (response) {
                        $("#success-msg").text(response);
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
                    if (errors.errors.hasOwnProperty("normal_range")) {
                        $("#update_normal_range_error").text(errors.errors.normal_range[0]);
                    }
                    if (errors.errors.hasOwnProperty("unit")) {
                        $("#update_unit_error").text(errors.errors.unit[0]);
                    }
                    if (errors.errors.hasOwnProperty("test_result_category_id")) {
                        $("#update_test_result_category_id_error").text(errors.errors.test_result_category_id[0]);
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
