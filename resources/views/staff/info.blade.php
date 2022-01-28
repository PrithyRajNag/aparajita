@extends('layouts.master')
@section('content')
    <div class="info-content">
        <div class="modal-header bg-info">
            <h4 class="modal-title text-light">Staff Information</h4>
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
                    <div>
                        <h2>Information</h2>

                        <input type="hidden" name="organization_id" id="organization_id">

                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold pt-0">Name : </label>
                            {{ucwords($data->full_name)}}
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold pt-0">NID : </label>
                            {{$data->nid}}
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold pt-0">Date Of Birth : </label>
                            {{ normalDateFormat($data->dob) }}
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold pt-0">Blood Group : </label>
                            {{ucwords($data->bloodGroups->name)}}
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold pt-0">Email Address : </label>
                            {{$data->email}}
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold pt-0">Mobile No : </label>
                            {{$data->phone_number}}
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold pt-0">Gender : </label>
                            {{ucfirst($data->gender)}}
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold pt-0">Address : </label>
                            {{ucwords($data->address)}}
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold pt-0">Monthly Salary : </label>
                            {{ucwords($data->salary)}}
                        </div>
                    </div>
                </div>
                <div class="m-auto">
                    @if(checkUserRole('staff.index'))
                        <a class="btn btn-success px-4 py-2" href="{{route('staff.index')}}">Back</a>
                    @endif
                    @if(checkUserRole('staff.update'))
                        <a class="btn btn-primary px-4 py-2" href="{{route('staff.edit',$data->id)}}">Update</a>
                    @endif
                </div>

            </form>
        </div>
    </div>
@endsection
