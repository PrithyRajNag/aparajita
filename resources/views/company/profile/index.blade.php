@extends('com_layouts.master')
@section('comContent')
    <!-- Start Admin Setting Model Area -->
    <div class="row justify-content-between mt-3">
        <div class="col-sm-6">
            @if(session('profile_success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {{ session('profile_success') }}
                </div>
            @endif
            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light lead align-self-center font-weight-normal">Edit Profile</span>
                </h4>
                <div class="card-body font-weight-normal row">
                    <form role="form" action="{{route('company.profile.update', $data->id)}}" class="clearfix"
                          method="POST" enctype="multipart/form-data"
                          style="width: 100%; display: contents;">
                        @csrf
                        @method('PUT')
                        <div class="form-group col-sm-6">
                            <label>First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name', $data->first_name) }}"
                                   class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control"
                                   value="{{ old('last_name', $data->last_name) }}" placeholder="Last Name" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Phone Number</label>
                            <input type="text" name="phone_number"
                                   value="{{ old('phone_number', $data->phone_number) }}"
                                   class="form-control" placeholder="Number" required>
                        </div>
                        <div class="form-group col-sm-12">
                            <label>Address:</label>
                            <textarea type="text" name="address" class="form-control" placeholder="Address"
                                      rows="2">{{ old('address', $data->address) }}</textarea>
                            @if ($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-sm-12 mt-3">
                            <img src="{{ getUserImage($data->image) }}" style="max-width: 200px;">
                        </div>
                        <div class="form-group col-md-6 mt-3">
                            <label>Profile Images</label>
                            <input type="file" class="default" name="image">
                        </div>
                        <div class="form-group mb-20 mt-3 col-md-4 offset-md-4">
                            <button type="submit" name="setting" id="" value="Update"
                                    class="btn btn-success btn-block btn-lg">Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            @if(session('pass_success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {{ session('pass_success') }}
                </div>
            @endif
            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light lead align-self-center font-weight-normal">Change Password</span>
                </h4>
                <div class="card-body font-weight-normal row">
                    <form role="form" action="{{ route('company.profile.passUpdate',auth()->guard('company')->user()->id) }}" class="clearfix"
                          method="post" style="width: 100%; display: contents;">
                        @csrf
                        @method("PUT")
                        <div class="form-group col-md-6">
                            <label>Current Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Current Password"
                                   required>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="new_password" class="form-control" placeholder="New Password"
                                   required>
                            @if ($errors->has('new_password'))
                                <span class="text-danger">{{ $errors->first('new_password') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control"
                                   placeholder="Confirm New Password">
                            @if ($errors->has('confirm_password'))
                                <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-20 mt-3 col-md-4 offset-md-4">
                            <button type="submit" id="" value="Update" class="btn btn-success btn-block btn-lg">Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Admin Setting Model Area -->
@endsection
