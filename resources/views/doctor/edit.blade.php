@extends('layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-12 m-4">
            <div class="card">
                <h4 class="card-header bg-transparent d-flex justify-content-between">
                    <span class="text-dark align-self-center">Edit Doctor</span>
                </h4>
                <div class="card-body f-14">
                    <form role="form" method="POST" id="editForm" action="{{route('doctor.update', $data->id ?? '')}}"
                          class="clearfix" style="width: 100%; display: contents;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="organization_id" id="organization_id">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">First Name:</label>
                            <div class="col-sm-6">
                                <input type="text" value="{{ old('first_name', $data->first_name ?? '') }}"
                                       name="first_name" id="first_name" class="form-control" placeholder="First Name">
                                @if ($errors->has('first_name'))
                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Last Name:</label>
                            <div class="col-sm-6">
                                <input type="text" value="{{ old('last_name', $data->last_name ?? '') }}"
                                       name="last_name" id="last_name" class="form-control" placeholder="Last Name">
                                @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Work Place:</label>
                            <div class="col-sm-6">
                                <select name="doctor_type" id="doctor_type" class="form-control">
                                    <option hidden
                                            value="{{ old('doctor_type', $data->doctorInfos->doctor_type ?? '') }}"> {{ucwords($data->doctorInfos->doctor_type ?? '')}}</option>
                                    <option value="indoor">Indoor</option>
                                    <option value="outdoor">Outdoor</option>
                                    <option value="indoor & outdoor">Both</option>
                                </select>
                                @if ($errors->has('doctor_type'))
                                    <span class="text-danger">{{ $errors->first('doctor_type') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Work Category:</label>
                            <div class="col-sm-6">
                                <select name="doctor_category" id="doctor_category" class="form-control">
                                    <option hidden
                                            value="{{ old('doctor_category', $data->doctorInfos->doctor_category ?? '') }}"> {{ucwords($data->doctorInfos->doctor_category ?? '')}}</option>
                                    <option value="permanent">Permanent</option>
                                    <option value="temporary">Temporary</option>
                                    <option value="on hire">On Hire</option>
                                    <option value="intern">Intern</option>
                                </select>
                                @if ($errors->has('doctor_category'))
                                    <span class="text-danger">{{ $errors->first('doctor_category') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold" required id="department_id">Select
                                Department</label>
                            <div class="col-sm-6">
                                <select name="department_id" class="form-control" required>
                                    <option hidden
                                            value="{{ old('department_id', $data->doctorInfos->department_id ?? '') }}"> {{ $data->doctorInfos->departments->name ?? '' }}</option>
                                    @foreach($departments as $item)
                                        <option
                                            value="{{ $item->id }}" {{$item->department_id == $item->id  ? 'selected' : ''}}>{{ucwords($item->name)}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('department_id'))
                                    <span class="text-danger">{{ $errors->first('department_id') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Speciality:</label>
                            <div class="col-sm-6">
                                <input type="text" name="speciality"
                                       value="{{ old('speciality', $data->doctorInfos->speciality ?? '') }}"
                                       id="speciality" class="form-control" placeholder="Speciality">
                                @if ($errors->has('speciality'))
                                    <span class="text-danger">{{ $errors->first('speciality') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Designation:</label>
                            <div class="col-sm-6">
                                <input type="text" name="designation" id="designation" class="form-control"
                                       value="{{ old('designation', $data->doctorInfos->designation ?? '') }}"
                                       placeholder="Designation">
                                @if ($errors->has('designation'))
                                    <span class="text-danger">{{ $errors->first('designation') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Date Of Birth:</label>
                            <div class="col-sm-6">
                                <input type="date" name="dob" id="dob" value="{{$data->dob ?? ''}}"
                                       class="form-control take_past_date" placeholder="Date Of Birth">
                                @if ($errors->has('dob'))
                                    <span class="text-danger">{{ $errors->first('dob') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold" required id="blood_group_id">Blood
                                Group:</label>
                            <div class="col-sm-6">
                                <select name="blood_group_id" id="blood_group_id" class="form-control">
                                    <option hidden
                                            value="{{ old('blood_group_id', $data->blood_group_id ?? '') }}"> {{ $data->bloodGroups->name ?? '' }}</option>
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
                            <label class="col-sm-3 col-form-label font-weight-bold">Email Address:</label>
                            <div class="col-sm-6">
                                <input type="email" DISABLED value="{{ old('email', $data->email ?? '') }}" name="email"
                                       id="email" class="form-control" placeholder="Email">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Mobile No:</label>
                            <div class="col-sm-6">
                                <input type="text" name="phone_number"
                                       value="{{ old('phone_number', $data->phone_number ?? '') }}" id="phone_number"
                                       class="form-control" placeholder="Number">
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
                                        <input type="radio" name="gender"
                                               value="male" {{ $data->gender == "male" ? "checked" : ""}}>
                                        <span class="mr-sm-2 mt-0">Male</span>
                                    </label>
                                    <label for="female">
                                        <input type="radio" name="gender"
                                               value="female" {{ ($data->gender === "female")? "checked" : ""}}>
                                        <span class="mr-sm-2">Female</span>
                                    </label>
                                    <label for="other">
                                        <input type="radio" name="gender"
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
                            <label class="col-sm-3 col-form-label font-weight-bold">Degree:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="degree" id="degree"
                                       value="{{ old('degree', $data->doctorInfos->degree ?? '') }}" placeholder="Degree">
                                @if ($errors->has('degree'))
                                    <span class="text-danger">{{ $errors->first('degree') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">National Id:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nid" id="nid"
                                       value="{{ old('nid', $data->nid ?? '') }}" placeholder="National Id Number">
                                @if ($errors->has('nid'))
                                    <span class="text-danger">{{ $errors->first('nid') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Joining Date:</label>
                            <div class="col-sm-6">
                                <input type="date" name="join_date" class="form-control take_past_date"
                                       value="{{ old('join_date', $data->join_date ?? '') }}" placeholder="Joining">
                                @if ($errors->has('join_date'))
                                    <span class="text-danger">{{ $errors->first('join_date') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Monthly Salary:</label>
                            <div class="col-sm-6">
                                <input type="number" min="0" class="form-control" name="salary" id="salary"
                                       value="{{ old('salary', $data->salary ?? '') }}" placeholder="Monthly Salary">
                                @if ($errors->has('salary'))
                                    <span class="text-danger">{{ $errors->first('salary') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Fees:</label>
                            <div class="col-sm-6">
                                <input type="number" min="0" class="form-control" name="fees" id="fees"
                                       value="{{ old('fees', $data->doctorInfos->fees ?? '') }}" placeholder="Fees">
                                @if ($errors->has('fees'))
                                    <span class="text-danger">{{ $errors->first('fees') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Address:</label>
                            <div class="col-sm-6">
                                <textarea type="text" name="address" id="address" class="form-control"
                                          placeholder="Address"
                                          rows="5">{{ old('address', $data->address ?? '') }}</textarea>
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
    <!-- End Create Doctor Model -->
@endsection
@push('customScripts')
    <script>



        $("#speciality").keyup(function () {
            let value_input = $("#speciality").val();

            let regexp = /[^a-zA-Z. ]/g;
            if (value_input.match(regexp)) {
                $("#speciality").val(value_input.replace(regexp, ''))
            }
        });

        $("#designation").keyup(function () {
            let value_input = $("#designation").val();

            let regexp = /[^a-zA-Z. ]/g;
            if (value_input.match(regexp)) {
                $("#designation").val(value_input.replace(regexp, ''))
            }
        });
        $("#degree").keyup(function () {
            let value_input = $("#degree").val();

            let regexp = /[^a-zA-Z. ]/g;
            if (value_input.match(regexp)) {
                $("#degree").val(value_input.replace(regexp, ''))
            }
        });
    </script>
@endpush
