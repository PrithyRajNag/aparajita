@extends('layouts.master')
@section('content')
    <!-- Start Account Daily Cost Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">

            @if(session('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {{ session('success') }}
                </div>
            @endif

            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Organization Bill</span>
                    @if(checkUserRole('bill.store'))
                        <a href="{{route('bill.create')}}" class="btn btn-light"><i class="fas fa-plus-circle"></i>&nbsp;
                            ADD</a>
                    @endif
                </h4>
                <div class="card-body f-14">
                    <div class="table-responsive" id="showDoctorList">
                        <table class="table table-striped text-canter table-col-bar">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Total Amount</th>
                                <th>Details</th>
                                <th>Paid By</th>
                                <th>Date</th>
                                <th>Document</th>
                                <th>Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->amount}}</td>
                                    <td>{{$item->note}}</td>
                                    <td>{{$item->users->full_name}}</td>

                                    <td>{{ normalDateFormat($item->date)}}</td>
                                    <td>
                                        @if($item->file != null)
                                            <a href="{{ route('bill.download',  $item->id) }}" class="btn btn-warning btn-sm"
                                               title="Click to download">Download</a>
                                        @else
                                            {{ __("No Files Available") }}

                                        @endif
                                    </td>


                                    @if(checkUserRole('action.bill'))
                                        <td>
                                            @if(checkUserRole('bill.edit'))
                                                <a href="{{route('bill.edit', $item->id)}}"
                                                   class="btn btn-primary f-12"><i class="fas fa-edit"></i>&nbsp;
                                                    Edit</a>
                                            @endif
                                            @if(checkUserRole('bill.destroy'))
                                                <form id="delete-form-{{ $loop->index }}"
                                                      action="{{ route('bill.destroy', $item->id) }}"
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
    <!-- End Bill List Model -->

    <!-- Start Add New Bill Model -->
    {{--@include('bill.create')--}}
    <!-- End Add New Bill Cost Model -->

    <!-- Start Edit Bill Cost Model -->
    {{--@include('bill.edit')--}}
    <!-- End Edit Accounts Cost Model -->

@endsection
@push('customScripts')
    <script>
{{--        // Script(For Create)--}}


{{--        $("form#createForm").submit(function(e) {--}}
{{--            e.preventDefault();--}}
{{--            var formData = new FormData(this);--}}
{{--            $.ajax({--}}
{{--                url: '/bill/store',--}}
{{--                type: 'POST',--}}
{{--                data: formData,--}}
{{--                success: function (data) {--}}
{{--                    alert(data)--}}
{{--                },--}}
{{--                cache: false,--}}
{{--                contentType: false,--}}
{{--                processData: false--}}
{{--            });--}}
{{--        });--}}


{{--        // $('#createForm').on('submit', function (e) {--}}
{{--        //     e.preventDefault();--}}
{{--        //--}}
{{--        //     $.ajax({--}}
{{--        //         url: '/bill/store',--}}
{{--        //         method: "POST",--}}
{{--        //         data: $(this).serialize(),--}}
{{--        //         beforeSend: function () {--}}
{{--        //             $('#createBtn').attr('disabled', true);--}}
{{--        //         },--}}
{{--        //--}}
{{--        //         success: function (response) {--}}
{{--        //             console.log("SUCCESS")--}}
{{--        //             console.log(response.toString());--}}
{{--        //             $("#success-msg").text(response);--}}
{{--        //             $('#add').modal('hide');--}}
{{--        //             setInterval('location.reload()', 1000);--}}
{{--        //             console.log("SUCCESS end")--}}
{{--        //         },--}}
{{--        //         error: function (xhr, status, error) {--}}
{{--        //             console.log("ERROR")--}}
{{--        //             console.log(xhr.responseText)--}}
{{--        //             let errors = JSON.parse(xhr.responseText);--}}
{{--        //             if (!errors.hasOwnProperty("errors")) {--}}
{{--        //                 $("#error-msg").text(errors.message);--}}
{{--        //                 $('#createBtn').attr('disabled', true);--}}
{{--        //                 return;--}}
{{--        //             }--}}
{{--        //--}}
{{--        //             if (errors.errors.hasOwnProperty("name")) {--}}
{{--        //                 $("#name_error").text(errors.errors.name[0]);--}}
{{--        //             }--}}
{{--        //             if (errors.errors.hasOwnProperty("note")) {--}}
{{--        //                 $("#note_error").text(errors.errors.note[0]);--}}
{{--        //             }--}}
{{--        //             if (errors.errors.hasOwnProperty("date")) {--}}
{{--        //                 $("#date_error").text(errors.errors.date[0]);--}}
{{--        //             }--}}
{{--        //             if (errors.errors.hasOwnProperty("amount")) {--}}
{{--        //                 $("#amount_error").text(errors.errors.amount[0]);--}}
{{--        //             }--}}
{{--        //             if (errors.errors.hasOwnProperty("user_id")) {--}}
{{--        //                 $("#user_id_error").text(errors.errors.user_id[0]);--}}
{{--        //             }--}}
{{--        //             if (errors.errors.hasOwnProperty("document")) {--}}
{{--        //                 $("#file_error").text(errors.errors.file[0]);--}}
{{--        //             }--}}
{{--        //         },--}}
{{--        //     })--}}
{{--        // })--}}


{{--        // Script(To show Data)--}}
{{--        function showData(item) {--}}

{{--            $("input[name*='id']").val(item.id);--}}
{{--            $("input[name*='name']").val(item.name);--}}
{{--            $("textarea[name*='note']").val(item.note);--}}
{{--            $("input[name*='date']").val(item.date);--}}
{{--            $("input[name*='amount']").val(item.amount);--}}
{{--            $("select[name*='user_id']").val(item.user_id);--}}
{{--            $("input[name*='file']").val(item.file);--}}
{{--        }--}}

{{--        // Script(For Update)--}}
{{--        $('#editForm').on('submit', function (e) {--}}
{{--            e.preventDefault();--}}
{{--            let id = $("input[name*='id']").val();--}}
{{--            let name = $("#name").val();--}}
{{--            let note = $("#note").val();--}}
{{--            let date = $("#date").val();--}}
{{--            let amount = $("#amount").val();--}}
{{--            let user_id = $("#user_id").val();--}}
{{--            let file = $("#file").val();--}}
{{--            console.log(status);--}}
{{--            $.ajax({--}}
{{--                url: '/bill/' + id + '/update',--}}
{{--                method: "PUT",--}}
{{--                data: {--}}
{{--                    _token: "{{ csrf_token() }}",--}}
{{--                    name: name,--}}
{{--                    note: note,--}}
{{--                    date: date,--}}
{{--                    amount: amount,--}}
{{--                    user_id: user_id,--}}
{{--                    file: file,--}}
{{--                    status: status,--}}
{{--                },--}}
{{--                success: function (response) {--}}
{{--                    if (response) {--}}
{{--                        $("#success-msg").text(response);--}}
{{--                        $('#edit').modal('hide');--}}
{{--                        setInterval('location.reload()', 1000);--}}
{{--                    }--}}
{{--                },--}}
{{--                error: function (xhr, status, error) {--}}
{{--                    let errors = JSON.parse(xhr.responseText);--}}
{{--                    if (!errors.hasOwnProperty("errors")) {--}}
{{--                        $("#error-msg").text(errors.message);--}}
{{--                        // $('#editBtn').attr('disabled', true);--}}
{{--                        return;--}}
{{--                    }--}}
{{--                    if (errors.errors.hasOwnProperty("name")) {--}}
{{--                        $("#update_name_error").text(errors.errors.name[0]);--}}
{{--                    }--}}
{{--                    if (errors.errors.hasOwnProperty("note")) {--}}
{{--                        $("#update_note_error").text(errors.errors.note[0]);--}}
{{--                    }--}}
{{--                    if (errors.errors.hasOwnProperty("date")) {--}}
{{--                        $("#update_date_error").text(errors.errors.date[0]);--}}
{{--                    }--}}
{{--                    if (errors.errors.hasOwnProperty("amount")) {--}}
{{--                        $("#update_amount_error").text(errors.errors.amount[0]);--}}
{{--                    }--}}
{{--                    if (errors.errors.hasOwnProperty("user_id")) {--}}
{{--                        $("#update_user_id_error").text(errors.errors.user_id[0]);--}}
{{--                    }--}}
{{--                    if (errors.errors.hasOwnProperty("file")) {--}}
{{--                        $("#update_file_error").text(errors.errors.file[0]);--}}
{{--                    }--}}
{{--                },--}}
{{--            })--}}
{{--        })--}}

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

