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

                <input type="hidden" name="organization_id" id="organization_id">

                <div class="bg-secondary p-lg-2 d-flex justify-content-between">
                   <span class="text-light align-self-center font-weight-bold">Patient Information</span>
                </div>
                <div class="form-group row">
                    <label class="col-sm-5 col-md-3 col-form-label font-weight-bold">Name:</label>
                    <label class="col-sm-7 col-md-9 col-form-label">{{ucwords($data->patients->full_name)}}</label>
                </div>

                <div class="form-group row">
                    <label class="col-sm-5 col-md-3 col-form-label font-weight-bold">Age:</label>
                    <label class="col-sm-7 col-md-9 col-form-label">{{ucwords($data->patients->age)}}</label>
                </div>
                <div class="form-group row">
                    <label class="col-sm-5 col-md-3 col-form-label font-weight-bold">Contact No:</label>
                    <label class="col-sm-7 col-md-9 col-form-label">{{ucwords($data->patients->phone_number)}}</label>
                </div>
                <div class="form-group row">
                    <label class="col-sm-5 col-md-3 col-form-label font-weight-bold">Gender:</label>
                    <label class="col-sm-7 col-md-9 col-form-label">{{ucwords($data->patients->gender)}}</label>
                </div>

                <div class="form-group row">
                    <label class="col-sm-5 col-md-3 col-form-label font-weight-bold">Address:</label>
                    <label class="col-sm-7 col-md-9 col-form-label">{{ucwords($data->patients->address)}}</label>
                </div>

                {{--@dd($data->referredDoctors->id)--}}
                @if($data->referred_doctor_id != null)
                    <div class="bg-secondary p-lg-2 d-flex justify-content-between">
                      <span class="text-light align-self-center font-weight-bold">Referred Doctor Information</span>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-md-3 col-form-label font-weight-bold">Name:</label>
                        <label class="col-sm-7 col-md-9 col-form-label">{{ucwords($data->referredDoctors->name)}}</label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-md-3 col-form-label font-weight-bold">Institution Name:</label>
                        <label class="col-sm-7 col-md-9 col-form-label">{{ucwords($data->referredDoctors->institution_name)}}</label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-md-3 col-form-label font-weight-bold">Contact No:</label>
                        <label class="col-sm-7 col-md-9 col-form-label">{{ucwords($data->referredDoctors->phone_number)}}</label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-md-3 col-form-label font-weight-bold">Degree:</label>
                        <label class="col-sm-7 col-md-9 col-form-label">{{ucwords($data->referredDoctors->degree)}}</label>
                    </div>
                @endif


                <div class="bg-secondary p-lg-2 d-flex justify-content-between">
                  <span class="text-light align-self-center font-weight-bold">Test Information</span>
                </div>
                <table class="table table-striped text-canter" id="testTable">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Test Name</th>
{{--                        <th>Input Date</th>--}}
{{--                        <th>Input Time</th>--}}
                        <th>Delivery Date</th>
                        <th>Delivery Time</th>
{{--                        <th>Action</th>--}}
                    </tr>
                    </thead>
                    <tbody id="testTableBody">
{{--                    @dd($data->patientTestItems)--}}
                    @foreach($data->patientTestItems as $item)
{{--                        @dd($item->tests)--}}
                        <tr>
                            <td>{{ ++$loop->index }}</td>
                            <td>{{ $item->tests->name }}</td>
{{--                            <td>{{ normalDateFormat($item->input_date) }}</td>--}}
{{--                            <td>{{ normalTimeFormat($item->input_time) }}</td>--}}
                            <td>
                                @if($item->delivery_date != null)
                                    {{ normalDateFormat($item->delivery_date) }}
                                @else()
                                    {{__('Not Given')}}
                                @endif
                            </td>
                            <td>
                                @if($item->delivery_time != null)
                                    {{ normalTimeFormat($item->delivery_time) }}
                                @else()
                                    {{__('Not Given')}}
                                @endif
                            </td>
{{--                            <td>--}}
{{--                                <a href="{{route('test.patient.show-item', $data->id)}}"--}}
{{--                                   class="btn btn-primary f-12 btn-sm"><i class="fas fa-eye"></i></a>--}}
{{--                            </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="form-group text-center">
                    {{--                        @if(checkUserRole('test.patient.index'))--}}
                    <a class="btn btn-success px-4 py-2" href="{{route('test.patient.index')}}">Back</a>
                    {{--                        @endif--}}
                    {{--                        @if(checkUserRole('test.patient.update'))--}}
                    <a class="btn btn-primary px-4 py-2" href="{{route('test.patient.edit',$data->id)}}">Update</a>
                    {{--                        @endif--}}
                </div>
            </form>
        </div>
    </div>
    {{--    </div>--}}


@endsection
