@extends('layouts.master')
@section('content')
    <!-- Start Create Staff Model -->
    <div class="row justify-content-center">
        <div class="col-sm-12 m-4">
            <div class="card">
                <h4 class="card-header bg-transparent d-flex justify-content-between">
                    <span class="text-dark align-self-center">Update Staff</span>
                </h4>
                <div class="card-body f-14">
                    {{--                    @if($errors->any())--}}
                    {{--                        {!! implode('', $errors->all('<div>:message</div>')) !!}--}}
                    {{--                        @endif--}}
                    <form role="form" class="clearfix" id="editForm" action="{{route('staff.update', $data->id)}}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="organization_id" id="organization_id">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">First Name:</label>
                            <div class="col-sm-6">
                                <input type="text" name="first_name" class="form-control"
                                       value="{{ old('first_name', $data->first_name) }}">
                                @if ($errors->has('first_name'))
                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Last Name:</label>
                            <div class="col-sm-6">
                                <input type="text" name="last_name" class="form-control"
                                       value="{{ old('last_name', $data->last_name) }}">
                                @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Date Of Birth:</label>
                            <div class="col-sm-6">
                                <input type="date" name="dob" class="form-control take_past_date" value="{{ old('dob', $data->dob) }}">
                                @if ($errors->has('dob'))
                                    <span class="text-danger">{{ $errors->first('dob') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Blood Group:</label>
                            <div class="col-sm-6">
                                <select name="blood_group_id" class="form-control">
                                    <option hidden
                                            value="{{ old('blood_group_id', $data->blood_group_id) }}"> {{ $data->bloodGroups->name }}</option>
                                    @foreach($bloodGroups as $item)
                                        <option
                                            value="{{ $item->id }}" {{$item->blood_group_id == $item->id  ? 'selected' : ''}}>{{ucwords($item->name)}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('blood_group_id'))
                                    <span class="text-danger">{{ $errors->first('blood_group_id') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Role:</label>
                            <div class="col-sm-6">
                                <select name="role" class="form-control">
                                    <option hidden
                                            value="{{ getRoleName($data) }}">{{ ucwords(getRoleName($data)) }}</option>
                                    @foreach($roles as $item)
                                        <option value="{{ $item->name }}">{{ ucwords($item->name) }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role'))
                                    <span class="text-danger">{{ $errors->first('role') }}</span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Email Address:</label>
                            <div class="col-sm-6">
                                <input type="email" name="email" class="form-control"
                                      disabled value="{{ old('email', $data->email) }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Mobile No:</label>
                            <div class="col-sm-6">
                                <input type="text" name="phone_number"
                                       value="{{ old('phone_number', $data->phone_number) }}" class="form-control"
                                       placeholder="Number">
                                @if ($errors->has('phone_number'))
                                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Gender:</label>
                            <div class="col-sm-6">
                                <div class="form-check form-check-inline">
                                    <label for="male">
                                        <input type="radio" id="gender" name="gender"
                                               value="male" {{ ($data->gender === "male")? "checked" : ""}}>
                                        <span class="mr-sm-2 mt-0">Male</span>
                                    </label>
                                    <label for="female">
                                        <input type="radio" id="gender" name="gender"
                                               value="female" {{ ($data->gender === "female")? "checked" : ""}}>
                                        <span class="mr-sm-2">Female</span>
                                    </label>
                                    <label for="other">
                                        <input type="radio" id="gender" name="gender"
                                               value="other" {{ ($data->gender === "other")? "checked" : ""}}>
                                        <span class="mr-sm-2">Other</span>
                                    </label>
                                    @if ($errors->has('gender'))
                                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">National Id:</label>
                            <div class="col-sm-6">
                                <input type="text" name="nid" class="form-control" value="{{ old('nid', $data->nid) }}"
                                       placeholder="National Id Number">
                                @if ($errors->has('nid'))
                                    <span class="text-danger">{{ $errors->first('nid') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Joining Date:</label>
                            <div class="col-sm-6">
                                <input type="date" name="join_date" class="form-control take_past_date" value="{{ old('join_date', $data->join_date) }}" placeholder="Joining">
                                @if ($errors->has('join_date'))
                                    <span class="text-danger">{{ $errors->first('join_date') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Monthly Salary</label>
                            <div class="col-sm-6">
                                <input type="number" name="salary" min="0" class="form-control"
                                       value="{{ old('salary', $data->salary) }}" placeholder="Monthly Salary">
                                @if ($errors->has('salary'))
                                    <span class="text-danger">{{ $errors->first('salary') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Address:</label>
                            <div class="col-sm-6">
                                <textarea type="text" name="address" class="form-control" placeholder="Address"
                                          rows="5">{{ old('address', $data->address) }}</textarea>
                                @if ($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Image:</label>
                            <div class="col-sm-6">
                                <div class="custom-file">
                                    <input type="file" name="image" id="image"/>
                                </div>
                                <div class="form-group col-sm-6">
                                    <div id="image-holder"  style="width: 200px; position: relative"></div>
                                </div>
                                @if ($errors->has('image'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group mb-20 col-sm-4 offset-4">
                            <button type="submit" name="editBtn" id="editBtn" value="Update"
                                    class="btn btn-primary btn-block btn-lg">Update
                            </button>
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
