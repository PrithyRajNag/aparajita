@extends('com_layouts.master')
@section('comContent')
        <div class="info-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Employee Information</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" action="" class="clearfix" method="post" enctype="multipart/form-data" style="width: 100%; display: contents;">


                    <div class="col-sm-5 text-center text-white">
                        <img src="{{ getUserImage($data->image) }}" class="img-fluid mt-2 p-2">
                    </div>
                    <div class="col-sm-7">
                        <div>
                            <h2>Information</h2>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label font-weight-bold pt-0" >Name : </label>
                                {{ucwords($data->full_name)}}
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label font-weight-bold pt-0">Date Of Birth : </label>
                                {{ Carbon\Carbon::parse($data->dob)->format('d F Y') }}
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label font-weight-bold pt-0">Employee Designation : </label>
                                {{$data->designations->name}}
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
                        </div>
                    </div>
                    <div class="m-auto">
                        <a class="btn btn-success px-4 py-2" href="{{route('company.employee.index')}}">Back</a>
                        <a class="btn btn-primary px-4 py-2" href="{{route('company.employee.edit',$data->id)}}">Update</a>
                    </div>

                </form>
            </div>
        </div>
{{--    </div>--}}
{{--</div>--}}
@endsection
