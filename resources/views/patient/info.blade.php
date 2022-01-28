@extends('layouts.master')
@section('content')
    <div class="info-content">
        <div class="modal-header bg-info">
            <h4 class="modal-title text-light">Patient Information</h4>
        </div>
        <div class="modal-body row">
            <form role="form" action="" class="clearfix" method="post" enctype="multipart/form-data"
                  style="width: 100%; display: contents;">
                <div class="col-sm-5 text-center text-white">
                    <img src="{{ getUserImage($data->image) }}" width="100%;" height="auto;"
                         class="img-fluid mt-2 p-2">
{{--                    <img src="{{asset("/storage/images/".$data->image)}}" class="img-thumbnail" width="100%"  >--}}
                </div>
                <div class="col-sm-7">
                    <h2 class="">Information</h2>

                    <input type="hidden" name="organization_id" id="organization_id">


                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Name:</label>
                        <label class="col-sm-7 col-form-label">{{ucwords($data->full_name)}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Mobile No:</label>
                        <label class="col-sm-7 col-form-label">{{$data->phone_number}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Age:</label>
                        <label class="col-sm-7 col-form-label">{{$data->age}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Date Of Birth:</label>
                        <label
                            class="col-sm-7 col-form-label">{{ normalDateFormat($data->dob) }}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Sex:</label>
                        <label class="col-sm-7 col-form-label">{{ucfirst($data->gender)}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Religion:</label>
                        <label class="col-sm-7 col-form-label">{{ucfirst($data->religion)}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Blood Group:</label>
                        <label class="col-sm-7 col-form-label">{{ucwords($data->bloodGroups->name)}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Address:</label>
                        <label class="col-sm-7 col-form-label">{{ucwords($data->address)}}</label>
                    </div>

                    @if(auth()->user()->organization->organization_type == 'hospital')
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold">Attendee Name:</label>
                            <label
                                class="col-sm-7 col-form-label">{{ucwords($data->patientAdmitDischarges[0]->attendee_name)}}</label>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold">Attendee Relation:</label>
                            <label
                                class="col-sm-7 col-form-label">{{ucwords($data->patientAdmitDischarges[0]->attendee_relation_with_patient)}}</label>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold">Note:</label>
                            <label
                                class="col-sm-7 col-form-label">{{ucwords($data->patientAdmitDischarges[0]->notes)}}</label>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold">Doctor Name:</label>
                            <label
                                class="col-sm-7 col-form-label">{{ucwords($data->doctorAssignToPatient->doctors[0]->full_name)}}</label>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold">Doctor Type For Patient:</label>
                            <label
                                class="col-sm-7 col-form-label">{{ucwords($data->doctorAssignToPatient->doctor_type_for_patient)}}</label>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold">Admit Date:</label>
                            <label
                                class="col-sm-7 col-form-label">{{ normalDateFormat($data->patientAdmitDischarges[0]->admit_date) }}</label>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold">Admit Time:</label>
                            <label
                                class="col-sm-7 col-form-label">{{ normalTimeFormat($data->patientAdmitDischarges[0]->admit_time) }}</label>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold">Discharge Date:</label>
                            <label
                                class="col-sm-7 col-form-label">{{ normalDateFormat($data->patientAdmitDischarges[0]->discharge_date) }}</label>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold">Discharge Time:</label>
                            <label
                                class="col-sm-7 col-form-label">{{ normalTimeFormat($data->patientAdmitDischarges[0]->discharge_time) }}</label>
                        </div>

                </div>
                @endif
                <div class="m-auto">
                    @if(checkUserRole('patient.index'))
                        <a class="btn btn-success px-4 py-2" href="{{route('patient.index')}}">Back</a>
                    @endif
                    @if(checkUserRole('patient.update'))
                        <a class="btn btn-primary px-4 py-2" href="{{route('patient.edit',$data->id)}}">Update</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
