@extends('layouts.master')
@section('content')
    <!-- Start Create Doctor Model -->
    <div class="row justify-content-center">
        <div class="col-sm-12 m-4">
            <div class="card">
                <h4 class="card-header bg-transparent d-flex justify-content-between">
                    <span class="text-dark align-self-center">Create New Doctor</span>
                </h4>
                <div class="card-body f-14">
                    {{--                    @if($errors->any())--}}
                    {{--                        {!! implode('', $errors->all('<div>:message</div>')) !!}--}}
                    {{--                        @endif--}}
                    <form role="form" class="clearfix" id="createForm" action="{{route('doctor.store')}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">First Name:</label>
                            <div class="col-sm-6">
                                <input type="text" name="first_name" class="form-control"
                                       value="{{ old('first_name') }}" placeholder="First Name">
                                @if ($errors->has('first_name'))
                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Last Name:</label>
                            <div class="col-sm-6">
                                <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}"
                                       placeholder="Last Name">
                                @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Work Place:</label>
                            <div class="col-sm-6">
                                <select name="doctor_type" class="form-control">
                                    <option hidden>Select Work Place</option>
                                    <option value="indoor"
                                            @if (old('doctor_type') == 'indoor') selected="selected" @endif>Indoor
                                    </option>
                                    <option value="outdoor"
                                            @if (old('doctor_type') == 'outdoor') selected="selected" @endif>Outdoor
                                    </option>
                                    <option value="indoor_outdoor"
                                            @if (old('doctor_type') == 'indoor_outdoor') selected="selected" @endif>Both
                                    </option>
                                </select>
                                @if ($errors->has('doctor_type'))
                                    <span class="text-danger">{{ $errors->first('doctor_type') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Work Category:</label>
                            <div class="col-sm-6">
                                <select name="doctor_category" class="form-control">
                                    {{--                                        <option value="{{ $doctor_category }}" {{ (Input::old("doctor_category") == $doctor_category ? "selected":"") }}>{{ $val }}</option>--}}
                                    {{--                                        <option value="male" @if (old('gender') == 'male') selected="selected" @endif>male</option>--}}
                                    <option hidden>Select Work Category</option>
                                    <option value="permanent"
                                            @if (old('doctor_category') == 'permanent') selected="selected" @endif>
                                        Permanent
                                    </option>
                                    <option value="temporary"
                                            @if (old('doctor_category') == 'temporary') selected="selected" @endif>
                                        Temporary
                                    </option>
                                    <option value="on_hire"
                                            @if (old('doctor_category') == 'on_hire') selected="selected" @endif>On Hire
                                    </option>
                                    <option value="intern"
                                            @if (old('doctor_category') == 'intern') selected="selected" @endif>Intern
                                    </option>
                                </select>
                                @if ($errors->has('doctor_category'))
                                    <span class="text-danger">{{ $errors->first('doctor_category') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Select Department</label>
                            <div class="col-sm-6">
                                <select name="department_id" class="form-control" required>
                                    <option hidden>Select Department</option>
                                    @foreach($departments as $item)
                                        <option value="{{ $item->id }}" {{ old("department_id") == $item->id ? "selected":"" }}>{{ $item->name }}</option>
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
                                <input type="text" name="speciality" id="speciality" class="form-control"
                                       value="{{ old('speciality') }}" placeholder="Speciality">
                                @if ($errors->has('speciality'))
                                    <span class="text-danger">{{ $errors->first('speciality') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Designation:</label>
                            <div class="col-sm-6">
                                <input type="text" name="designation" id="designation" class="form-control"
                                       value="{{ old('designation') }}" placeholder="Designation">
                                @if ($errors->has('designation'))
                                    <span class="text-danger">{{ $errors->first('designation') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Date Of Birth:</label>
                            <div class="col-sm-6">
                                <input type="date" name="dob" class="form-control take_past_date"
                                       value="{{ old('dob') }}" placeholder="Date Of Birth">
                                @if ($errors->has('dob'))
                                    <span class="text-danger">{{ $errors->first('dob') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Blood Group:</label>
                            <div class="col-sm-6">
                                <select name="blood_group_id" class="form-control">
                                    <option hidden>Select Blood Group</option>
                                    @foreach($bloodGroups as $item)
                                        <option value="{{ $item->id }}" {{ old("blood_group_id") == $item->id ? "selected":"" }}>{{ $item->name }}</option>
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
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                       placeholder="Email">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Mobile No:</label>
                            <div class="col-sm-6">
                                <input type="text" name="phone_number" class="form-control"
                                       value="{{ old('phone_number') }}" placeholder="Number">
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
                                        <input type="radio" id="gender" name="gender" value="male">
                                        <span class="mr-sm-2 mt-0">Male</span>
                                    </label>
                                    <label for="female">
                                        <input type="radio" id="gender" name="gender" value="female">
                                        <span class="mr-sm-2">Female</span>
                                    </label>
                                    <label for="other">
                                        <input type="radio" id="gender" name="gender" value="other">
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
                                <input type="text" name="nid" class="form-control" value="{{ old('nid') }}"
                                       placeholder="National Id Number">
                                @if ($errors->has('nid'))
                                    <span class="text-danger">{{ $errors->first('nid') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Degree:</label>
                            <div class="col-sm-6">
                                <input type="text" name="degree" class="form-control" value="{{ old('degree') }}"
                                       placeholder="Degree">
                                @if ($errors->has('degree'))
                                    <span class="text-danger">{{ $errors->first('degree') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Joining Date:</label>
                            <div class="col-sm-6">
                                <input type="date" name="join_date" class="form-control take_past_date"
                                       value="{{ old('join_date') }}" placeholder="Joining">
                                @if ($errors->has('join_date'))
                                    <span class="text-danger">{{ $errors->first('join_date') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Monthly Salary:</label>
                            <div class="col-sm-6">
                                <input type="number" name="salary" min="0" class="form-control"
                                       value="{{ old('salary') }}" placeholder="Monthly Salary">
                                @if ($errors->has('salary'))
                                    <span class="text-danger">{{ $errors->first('salary') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Fees:</label>
                            <div class="col-sm-6">
                                <input type="number" name="fees" min="0" class="form-control" value="{{ old('fees') }}"
                                       placeholder="Fees">
                                @if ($errors->has('fees'))
                                    <span class="text-danger">{{ $errors->first('fees') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Address:</label>
                            <div class="col-sm-6">
                                <textarea type="text" name="address" class="form-control" placeholder="Address"
                                          rows="5">{{ old('address') }}</textarea>
                                @if ($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Image:</label>
                            <div class="col-sm-6">
                                <div class="custom-file">
                                    <input type="file" name="image" id="image" value="{{ old('image') }}" />
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
                            <button type="submit" name="createBtn" id="createBtn" value="Save"
                                    class="btn btn-success btn-block btn-lg">Save
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
        // Browser validation

        $("input[name*='speciality']").keyup(function () {
            let value_input = $("input[name*='speciality']").val();

            let regexp = /[^a-zA-Z. ]/g;
            if (value_input.match(regexp)) {
                $("input[name*='speciality']").val(value_input.replace(regexp, ''))
            }
        });
        $("input[name*='designation']").keyup(function () {
            let value_input = $("input[name*='designation']").val();

            let regexp = /[^a-zA-Z. ]/g;
            if (value_input.match(regexp)) {
                $("input[name*='designation']").val(value_input.replace(regexp, ''))
            }
        });
        $("input[name*='degree']").keyup(function () {
            let value_input = $("input[name*='degree']").val();

            let regexp = /[^a-zA-Z. ]/g;
            if (value_input.match(regexp)) {
                $("input[name*='degree']").val(value_input.replace(regexp, ''))
            }
        });

    </script>
@endpush
