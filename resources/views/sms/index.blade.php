@extends('layouts.master')
@section('content')
<!-- Start Sent SMS Model -->
<div class="row justify-content-center">
    <div class="col-lg-12 m-3">
        <div id="success-msg" class="alert alert-success"></div>

        <div class="card border-success">
            <h4 class="card-header bg-success d-flex justify-content-between">
                <span class="modal-title text-light align-self-center">Sent Sms</span>
                <div class="align-self-center">
                    @if(checkUserRole('sms.send'))
                        <a href="#" id="createFormBtn" class="btn btn-light" data-toggle="modal" data-target="#add"><i
                                class="fas fa-plus-circle"></i>&nbsp; Send Sms</a>
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
                            <th>Message</th>
                            <th>Date & Time</th>
{{--                            <th>Time</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contentData as $item)
                            <tr>
{{--                                @dd($item)--}}
                                <td>{{ ++$loop->index }}</td>
                                <td>{{ ucwords($item->receiver) }}</td>
                                <td>{{ ucwords($item->message) }}</td>
                                <td>{{ $item->created_at }}</td>
{{--                                <td>{{ normalDateFormat($item->date)}}</td>--}}
{{--                                <td>{{ normalTimeFormat($item->time)}}</td>--}}

                                {{--                                    <td>--}}
                                {{--                                                @if(checkUserRole('sms.destroy'))--}}
                                {{--                                        <form id="delete-form-{{ $loop->index }}"--}}
                                {{--                                              action="{{ route('sms.destroy', $item->id) }}"--}}
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
{{--    <div class="col-sm-12 m-3">--}}
{{--        <div class="card-deck mt-3 text-light text-center font-weight-bold">--}}

{{--            <div class="card bg-info">--}}
{{--                <div class="card-body text-left">--}}
{{--                    <h3>0</h3>--}}
{{--                    <p class="font-weight-normal">Today's Message</p>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="card bg-primary">--}}
{{--                <div class="card-body text-left">--}}
{{--                    <h3>0</h3>--}}
{{--                    <p class="font-weight-normal">Today Send</p>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="card bg-warning">--}}
{{--                <div class="card-body text-left">--}}
{{--                    <h3 class="text-dark">2500</h3>--}}
{{--                    <p class="font-weight-normal text-dark">Available Now</p>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="card bg-danger">--}}
{{--                <div class="card-body text-left">--}}
{{--                    <h3>15</h3>--}}
{{--                    <p class="font-weight-normal">Total Send</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-sm-12">--}}
{{--        <div class="card border-success">--}}
{{--            <h4 class="card-header bg-success d-flex justify-content-between">--}}
{{--                <span class="modal-title text-light align-self-center">Sent SMS</span>--}}
{{--                <div class="align-self-center">--}}
{{--                    <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addSms"><i class="fas fa-plus-circle"></i>&nbsp; Sent SMS</a>--}}

{{--                    <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addSmsSetting"><i class="fas fa-tools"></i>&nbsp; Setting</a>--}}
{{--                </div>--}}
{{--            </h4>--}}
{{--            <div class="card-body f-12">--}}
{{--                <div class="table-responsive" id="">--}}
{{--                    <table class="table table-striped text-canter table-col-bar">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>Id</th>--}}
{{--                            <th>Number</th>--}}
{{--                            <th>Messages</th>--}}
{{--                            <th>Date & Time</th>--}}
{{--                            <th>Option</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <td>22</td>--}}
{{--                            <td>+880127000000</td>--}}
{{--                            <td width="300px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>--}}
{{--                            <td>12/20/2020 : 10:30 AM</td>--}}
{{--                            <td>--}}
{{--                                <a href="#" class="btn btn-info f-10" data-toggle="model" data-target="#infoEmail"><i class="fas fa-plus-circle"></i>&nbsp; Info</a>--}}

{{--                                <a href="#" class="btn btn-danger f-10" data-toggle="modal" data-target="#"><i class="fas fa-plus-circle"></i>&nbsp; Delete</a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
<!-- End Sent SMS Model -->

<!-- Start New Sent SMS Model -->
@include('sms.sent_sms')
<!-- End New Sent SMS Model -->

<!-- Start Send SMS Setting Model -->
{{--@include('sms.settings')--}}
<!-- End Send SMS Setting Model -->
@endsection
@push('customScripts')
    <script>
        // Script(For Create)
        $('#createForm').on('submit', function (e) {
            e.preventDefault();
            console.log('submit pressed');
            $.ajax({
                url: '/sms/send',
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
                    if (errors.errors.hasOwnProperty("receiver")) {
                        $("#receiver_error").text(errors.errors.receiver[0]);
                    }
                    if (errors.errors.hasOwnProperty("message")) {
                        $("#message_error").text(errors.errors.message[0]);
                    }
                },
            })
        })

        $("#receiver").hide();

        $('input[name="sms_to"]').on('change', function () {
            if (this.value != 'specific') {
                $("#receiver").hide()
            } else {
                $("#receiver").show()
            }
        });

    </script>

@endpush
