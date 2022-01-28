@extends('com_layouts.master')
@section('comContent')
    <!-- Start Create Staff Model -->
    <div class="row justify-content-center">
        <div class="col-sm-12 m-4">
            <div class="card">
                <h4 class="card-header bg-transparent d-flex justify-content-between">
                    <span class="text-dark align-self-center">Update Employee</span>
                </h4>
                <div class="card-body f-14">

                    <form role="form" class="clearfix" id="createForm" action="{{route('company.employee.update', $data->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="organization_id" id="organization_id">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">First Name:</label>
                            <div class="col-sm-6">
                                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $data->first_name) }}">
                            </div>
                            @if ($errors->has('first_name'))
                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Last Name:</label>
                            <div class="col-sm-6">
                                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $data->last_name) }}">
                            </div>
                            @if ($errors->has('last_name'))
                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Date Of Birth:</label>
                            <div class="col-sm-6">
                                <input type="date" name="dob" class="form-control" value="{{ old('dob', $data->dob) }}">
                            </div>
                            @if ($errors->has('dob'))
                                <span class="text-danger">{{ $errors->first('dob') }}</span>
                            @endif
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Email Address:</label>
                            <div class="col-sm-6">
                                <input type="email" name="email" class="form-control" value="{{$data->email}}" value="{{ old('email', $data->email) }}">
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Mobile No:</label>
                            <div class="col-sm-6">
                                <input type="text" name="phone_number" value="{{ old('phone_number', $data->phone_number) }}" class="form-control" placeholder="Number">
                            </div>
                            @if ($errors->has('phone_number'))
                                <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Company Designation:</label>
                            <div class="col-sm-6">
                                <select name="company_designation_id" class="form-control">
                                    <option  hidden value="{{ old('company_designation_id', $data->designations->id) }}"> {{ $data->designations->name }}</option>
                                    @foreach($designations as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('company_designation_id'))
                                    <span class="text-danger">{{ $errors->first('company_designation_id') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Sex:</label>
                            <div class="col-sm-6">
                                <div class="form-check form-check-inline">
                                    <label for="male">
                                        <input type="radio" id="gender" name="gender" value="male" {{ ($data->gender === "male")? "checked" : ""}}>
                                        <span class="mr-sm-2 mt-0">Male</span>
                                    </label>
                                    <label for="female">
                                        <input type="radio" id="gender" name="gender" value="female" {{ ($data->gender === "female")? "checked" : ""}}>
                                        <span class="mr-sm-2">Female</span>
                                    </label>
                                    <label for="other">
                                        <input type="radio" id="gender" name="gender" value="other" {{ ($data->gender === "other")? "checked" : ""}}>
                                        <span class="mr-sm-2">Other</span>
                                    </label>
                                </div>
                                @if ($errors->has('gender'))
                                    <span class="text-danger">{{ $errors->first('gender') }}</span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Address:</label>
                            <div class="col-sm-6">
                                <textarea type="text" name="address" class="form-control" placeholder="Address" rows="5">{{ old('address', $data->address) }}</textarea>
                            </div>
                            @if ($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Picture:</label>
                            <div class="col-sm-6">
                                <input type="file" class="default" name="image" value="{{ old('image', $data->image) }}" placeholder="Picture">
                            </div>
                            @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-20 col-sm-4 offset-4">
                            <button type="submit" name="editBtn" id="editBtn" value="Update" class="btn btn-primary btn-block btn-lg">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Create staff Model -->
@endsection
@push('customScripts')

@endpush
