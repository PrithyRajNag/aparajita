@extends('layouts.master')
@section('content')
    {{--    <div class="modal-dialog modal-lg modal-dialog-centered">--}}
    <div class="info-content">
        <div class="modal-header bg-info">
            <h4 class="modal-title text-light">Doctor Information</h4>
        </div>
        <div class="modal-body row">
            <form role="form" action="" class="clearfix" method="post" enctype="multipart/form-data"
                  style="width: 100%; display: contents;">
                <div class="col-sm-5 text-center">
                    <img src="{{ getUserImage($data->image) }}" width="100%;" height="auto;"
                         class="img-fluid mt-2 p-2">
{{--                    <img src="{{asset("/storage/images/".$data->image)}}" class="img-thumbnail" width="100%"  >--}}
                </div>
                <div class="col-sm-7">
                    <h2 class="">Information</h2>

                    <input type="hidden" name="organization_id" id="organization_id">


                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Name:</label>
                        <label class="col-sm-7 col-form-label">{{ucwords($data->full_name ?? '')}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Work Place:</label>
                        <label class="col-sm-7 col-form-label">{{ucwords($data->doctorInfos->doctor_type ?? '')}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Degree:</label>
                        <label class="col-sm-7 col-form-label">{{ucwords($data->doctorInfos->degree ?? '')}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">NID:</label>
                        <label class="col-sm-7 col-form-label">{{$data->nid ?? ''}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Work Category:</label>
                        <label class="col-sm-7 col-form-label">{{ucwords($data->doctorInfos->doctor_category ?? '')}}</label>

                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Department</label>
                        <label
                            class="col-sm-7 col-form-label">{{ucwords($data->doctorInfos->departments->name ?? '')}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Speciality:</label>
                        <label class="col-sm-7 col-form-label">{{ucwords($data->doctorInfos->speciality ?? '')}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Designation:</label>
                        <label class="col-sm-7 col-form-label">{{ucwords($data->doctorInfos->designation ?? '')}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Date Of Birth:</label>
                        <label
                            class="col-sm-7 col-form-label">{{ normalDateFormat($data->dob ?? '') }}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Blood Group:</label>
                        <label class="col-sm-7 col-form-label">{{ucwords($data->bloodGroups->name ?? '')}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Email Address:</label>
                        <label class="col-sm-7 col-form-label">{{$data->email ?? ''}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Mobile No:</label>
                        <label class="col-sm-7 col-form-label">{{$data->phone_number ?? ''}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Sex:</label>
                        <label class="col-sm-7 col-form-label">{{ucfirst($data->gender ?? '')}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Address:</label>
                        <label class="col-sm-7 col-form-label">{{ucwords($data->address ?? '')}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Monthly Salary:</label>
                        <label class="col-sm-7 col-form-label">{{ucwords($data->salary ?? '')}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Fees:</label>
                        <label class="col-sm-7 col-form-label">{{ucwords($data->doctorInfos->fees ?? '')}}</label>
                    </div>
                </div>
                <div class="m-auto">
                    @if(checkUserRole('doctor.index'))
                        <a class="btn btn-success px-4 py-2" href="{{route('doctor.index')}}">Back</a>
                    @endif
                    @if(checkUserRole('doctor.update'))
                        <a class="btn btn-primary px-4 py-2" href="{{route('doctor.edit',$data->id)}}">Update</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    {{--    </div>--}}


@endsection
