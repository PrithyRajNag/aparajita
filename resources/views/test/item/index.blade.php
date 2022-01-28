@extends('layouts.master')
@section('content')
    <!-- Start Test Item Model -->
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
                    <span class="text-light align-self-center">Test Item</span>
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
                                <th>Test Item Name</th>
                                <th>Test Category Name</th>
                                <th>Price</th>
                                <th>Details</th>
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
                                    <td>{{ucwords($item->testCategory->name)}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->description}}</td>
{{--                                    @if(checkUserRole('action.test.index'))--}}
                                        <td>
{{--                                            @if(checkUserRole('test.update'))--}}
                                                <a href="#" class="btn btn-primary f-12" onclick="showData({{ $item }})"
                                                   data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i>&nbsp;
                                                    Edit</a>
{{--                                            @endif--}}
{{--                                            @if(checkUserRole('test.destroy'))--}}
                                                <form id="delete-form-{{ $loop->index }}"
                                                      action="{{ route('test.item.destroy', $item->id) }}"
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
    <!-- End Test Item List Model -->

    <!-- Start Add New Test Item Model -->
    @include('test.item.create')
    <!-- End Add New Test Item Model -->

    <!-- Start Edit Test Item Model -->
    @include('test.item.edit')
    <!-- End Edit Test Item Model -->
@endsection

@push('customScripts')
    <script>

        $('#createFormBtn').click(function () {
            $('#name_error').text('');
            $('#description_error').text('');
            $('#price_error').text('');
            $('#test_category_id_error').select();

            $('#createBtn').attr('disabled', false);
        });


        // Browser validation
        $("input[name*='price']").keyup(function () {
            let value_input = $("input[name*='price']").val();

            let regexp = /[^0-9.]/g;
            if (value_input.match(regexp)) {
                $("input[name*='price']").val(value_input.replace(regexp, ''))
            }
            $("#price_error").text('');
            $('#createBtn').attr('disabled', false);
        });


        // Script(To show Data)
        function showData(item) {

            $("input[name*='id']").val(item.id);
            $("input[name*='name']").val(item.name);
            $("input[name*='price']").val(item.price);
            $("select[name*='test_category_id']").val(item.test_category_id);
            $("textarea[name*='description']").val(item.description);
        }

        // Script(For Create)
        $('#createForm').on('submit', function (e) {
            e.preventDefault($(this).serialize());
            console.log()
            $.ajax({
                url: '/test/item/store',
                method: "POST",
                data: $(this).serialize(),
                beforeSend: function () {
                    // $('#createBtn').attr('disabled', true);
                },
                success: function (response) {
                    $("#success-msg").text(response);
                    $('#add').modal('hide');
                    setInterval('location.reload()', 1000);
                },


            })
        })


        // Script(For Update)
        $('#editForm').on('submit', function (e) {
            e.preventDefault();
            console.log('Inserted');
            let id = $("input[name*='id']").val();
            let name = $("#name").val();
            let price = $("#price").val();
            let description = $("#description").val();
            let test_category_id = $("#test_category_id").val();
            $.ajax({
                url: '/test/item/' + id + '/update',
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name,
                    description: description,
                    price: price,
                    test_category_id: test_category_id,
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
                    if (errors.errors.hasOwnProperty("test_category_id")) {
                        $("#update_test_category_id_error").text(errors.errors.test_category_id[0]);
                    }
                    if (errors.errors.hasOwnProperty("price")) {
                        $("#update_price_error").text(errors.errors.price[0]);
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
