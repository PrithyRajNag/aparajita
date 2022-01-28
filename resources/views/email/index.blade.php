@extends('layouts.master')
@section('content')

    {{--    <head>--}}
    {{--        <meta charset="UTF-8">--}}
    {{--        <meta name="viewport"--}}
    {{--              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
    {{--        <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
    {{--        <title>Innovative Software Limited</title>--}}
    {{--    </head>--}}
    {{--    <body>--}}
    {{--    <h1>{{$details['title']}}</h1>--}}
    {{--    <p>{{$details['body']}}</p>--}}
    {{--    <p>Thank You</p>--}}
    {{--    </body>--}}
    {{--    </html>--}}










    <!-- Start Email Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            <div id="success-msg" class="alert alert-success"></div>

            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="modal-title text-light align-self-center">Sent Email</span>
                    <div class="align-self-center">
                        @if(checkUserRole('email.send'))
                        <a href="#" id="createFormBtn" class="btn btn-light" data-toggle="modal" data-target="#add"><i
                                class="fas fa-plus-circle"></i>&nbsp; Send Mail</a>
                        @endif

                        {{--                    <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addEmailSetting"><i class="fas fa-tools"></i>&nbsp; Setting</a>--}}
                    </div>
                </h4>
                <div class="card-body f-12">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Receiver</th>
                                <th>Subject</th>
                                <th>Message</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ $item->email_id}}</td>
                                    <td>{{ ucwords($item->subject) }}</td>
                                    <td>{{ ucwords($item->description)}}</td>

{{--                                    <td>--}}
{{--                                                @if(checkUserRole('email.destroy'))--}}
{{--                                        <form id="delete-form-{{ $loop->index }}"--}}
{{--                                              action="{{ route('email.destroy', $item->id) }}"--}}
{{--                                              method="post"--}}
{{--                                              class="form-horizontal d-inline">--}}
{{--                                            {{ csrf_field() }}--}}
{{--                                            <input type="hidden" name="_method" value="DELETE">--}}
{{--                                            <div class="btn-group">--}}
{{--                                                <button onclick="deleteData({{ $loop->index }})" type="button"--}}
{{--                                                        class="btn btn-danger waves-effect waves-light btn-sm align-items-center">--}}
{{--                                                    <i class="fas fa-trash"></i>&nbsp; Delete--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                                    @endif--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Email Model -->

    <!-- Start New Sent Email Model -->
    @include('email.sent_email')
    <!-- End New Sent Email Model -->

    <!-- Start Send Message Email Model -->
{{--    @include('email.settings')--}}
    <!-- End Send Message Email Model -->
@endsection
@push('customScripts')
    <script>
        // Script(For Create)
        $('#createForm').on('submit', function (e) {
            e.preventDefault();
            console.log('submit pressed');
            $.ajax({
                url: '/email/send',
                method: "POST",
                data: $(this).serialize(),
                beforeSend: function () {
                    // $('#createBtn').attr('disabled', true);
                },
                success: function (response) {
                    console.log('success')
                    console.log(response)
                    $("#success-msg").text(response);
                    console.log('success')
                    $('#add').modal('hide');
                    setInterval('location.reload()', 1000);
                },
                error: function (xhr, status, error) {
                    let errors = JSON.parse(xhr.responseText);
                    if  (! errors.hasOwnProperty("errors")) {
                        $("#error-msg").text(errors.message);
                        $('#createBtn').attr('disabled', true);
                        return;
                    }
                    if (errors.errors.hasOwnProperty("email_id")) {
                        $("#email_id_error").text(errors.errors.email_id[0]);
                    }
                    if (errors.errors.hasOwnProperty("subject")) {
                        $("#subject_error").text(errors.errors.subject[0]);
                    }
                    if (errors.errors.hasOwnProperty("description")) {
                        $("#description_error").text(errors.errors.description[0]);
                    }
                },
            })
        })

        $("#email_id").hide();

        $('input[name="email_to"]').on('change', function () {
            if (this.value != 'specific') {
                $("#email_id").hide()
            } else {
                $("#email_id").show()
            }
        });

    </script>

@endpush
