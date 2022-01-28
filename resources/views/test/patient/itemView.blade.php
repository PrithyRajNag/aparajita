@extends('layouts.master')
@section('content')
    {{--    <div class="modal-dialog modal-lg modal-dialog-centered">--}}
    <div class="info-content">
        <div class="modal-header bg-info">
            <h4 class="modal-title text-light">Patient Test Information</h4>
        </div>
        <div class="modal-body">
            <form role="form" action="" class="clearfix" method="post" enctype="multipart/form-data"
                  style="width: 100%; display: contents;">
{{--                @dd($data->tests)--}}
{{--                @dd($data->patientTests)--}}
{{--                @dd($data->patientTests->patients)--}}
                <div class="form-group row pb-3">
                    <label class="col-sm-5 col-md-3 col-form-label font-weight-bolder">Test Entry No:</label>
                    <label class="col-sm-7 col-md-9 col-form-label font-weight-bold">{{ucwords($data->patientTests->patient_test_no)}}</label>
                </div>

                <div class="bg-secondary p-lg-2 d-flex justify-content-between">
                    <span class="text-light align-self-center font-weight-bold">Patient Information</span>
                </div>
                <div class="form-group row">
                    <label class="col-sm-5 col-md-3 col-form-label font-weight-bold">Patient Name:</label>
                    <label class="col-sm-7 col-md-9 col-form-label">{{ucwords($data->patientTests->patients->full_name)}}</label>
                </div>
                <div class="form-group row">
                    <label class="col-sm-5 col-md-3 col-form-label font-weight-bold">Patient Age:</label>
                    <label class="col-sm-7 col-md-9 col-form-label">{{ucwords($data->patientTests->patients->age)}}</label>
                </div>
                <div class="form-group row">
                    <label class="col-sm-5 col-md-3 col-form-label font-weight-bold">Patient Contact:</label>
                    <label class="col-sm-7 col-md-9 col-form-label">{{ucwords($data->patientTests->patients->phone_number)}}</label>
                </div>
                <div class="form-group row">
                    <label class="col-sm-5 col-md-3 col-form-label font-weight-bold">Patient Address:</label>
                    <label class="col-sm-7 col-md-9 col-form-label">{{ucwords($data->patientTests->patients->address)}}</label>
                </div>
                <div class="form-group row">
                    <label class="col-sm-5 col-md-3 col-form-label font-weight-bold">Patient Address:</label>
                    <label class="col-sm-7 col-md-9 col-form-label">{{ucwords($data->patientTests->patients->address)}}</label>
                </div>

                <div class="bg-secondary p-lg-2 d-flex justify-content-between">
                    <span class="text-light align-self-center font-weight-bold">Test Information</span>
                </div>
                <div class="form-group row">
                    <label class="col-sm-5 col-md-3 col-form-label font-weight-bold">Test Name:</label>
                    <label class="col-sm-7 col-md-9 col-form-label">{{ucwords($data->tests->name)}}</label>
                </div>

            </form>
        </div>
    </div>
    {{--    </div>--}}


@endsection
