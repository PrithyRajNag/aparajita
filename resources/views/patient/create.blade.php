@extends('layouts.master')
@section('content')
    {{--    <div class="modal fade" id="addPatient">--}}
    {{--    <div class=" modal-lg modal-dialog-centered">--}}
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h4 class="modal-title text-light">Add Patient</h4>
        </div>
        <div class="modal-body row">
            <form role="form" action="{{route('patient.store')}}" class="clearfix" method="POST"
                  enctype="multipart/form-data" style="width: 100%; display: contents;">
                @csrf


                {{--   /////////////Need For All Type///////////--}}
                <div class="form-group col-md-4">
                    <label>First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control"
                           placeholder="First Name" required>

                    @if ($errors->has('first_name'))
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control"
                           placeholder="Last Name" required>

                    @if ($errors->has('last_name'))
                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label>Phone</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control"
                           placeholder="+880" required>
                    @if ($errors->has('phone_number'))
                        <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label>Age</label>
                    <input type="number" name="age" min="0" value="{{ old('age') }}" class="form-control"
                           placeholder="Age" required>
                    @if ($errors->has('age'))
                        <span class="text-danger">{{ $errors->first('age') }}</span>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label>Date Of Birth</label>
                    <input type="date" name="dob" class="form-control take_past_date" value="{{ old('dob') }}"
                           placeholder="Date Of Birth">
                    @if ($errors->has('dob'))
                        <span class="text-danger">{{ $errors->first('dob') }}</span>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label>Gender</label>
                    <select name="gender" class="form-control">
                        <option hidden></option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    @if ($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label>Blood Group:</label>
                    <select name="blood_group_id" class="form-control">
                        <option hidden></option>
                        @foreach($bloodGroups as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('blood_group_id'))
                        <span class="text-danger">{{ $errors->first('blood_group_id') }}</span>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label>Religion</label>
                    <select name="religion" class="form-control">
                        <option hidden></option>
                        <option value="hinduism">Hinduism</option>
                        <option value="islam">Islam</option>
                        <option value="buddhist">Buddhist</option>
                        <option value="christian">Christian</option>
                    </select>
                    @if ($errors->has('religion'))
                        <span class="text-danger">{{ $errors->first('religion') }}</span>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label>Address</label>
                    <textarea type="text" name="address" class="form-control"
                              placeholder="Address">{{ old('address') }}</textarea>
                    @if ($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label class="">Image:</label>
{{--                    <div class="">--}}
                        <div class="custom-file">
                            <input type="file" name="image" id="image" value="{{ old('image') }}" />
                        </div>
                        <div class="form-group">
                            <div id="image-holder"  style="width: 200px; position: relative"></div>
                        </div>
                        @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
{{--                    </div>--}}
                </div>

                {{--      /////////Need For Hospital//////////--}}
                @if(auth()->user()->organization->organization_type == 'hospital')
                    <div class="form-group col-md-4">
                        <label>Attendee Name</label>
                        <input type="text" name="attendee_name" class="form-control" value="{{ old('attendee_name') }}"
                               placeholder="Attendee Name">
                        @if ($errors->has('attendee_name'))
                            <span class="text-danger">{{ $errors->first('attendee_name') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label>Attendee Relation</label>
                        <input type="text" name="attendee_relation_with_patient" class="form-control"
                               value="{{ old('attendee_relation_with_patient') }}"
                               placeholder="Attendee Relation">
                        @if ($errors->has('attendee_relation_with_patient'))
                            <span class="text-danger">{{ $errors->first('attendee_relation_with_patient') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label>Note</label>
                        <textarea type="text" name="notes" class="form-control"
                                  placeholder="Notes">{{ old('notes') }}</textarea>
                        @if ($errors->has('notes'))
                            <span class="text-danger">{{ $errors->first('notes') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label>Doctor Name</label>
                        <select name="doctor_id" class="form-control">
                            <option hidden></option>
                            @foreach($doctors as $item)
                                <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('doctor_id'))
                            <span class="text-danger">{{ $errors->first('doctor_id') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label>Doctor Type For Patient</label>
                        <select name="doctor_type_for_patient" class="form-control">
                            <option hidden></option>
                            <option value="root">Root</option>
                            <option value="referred">Referred</option>
                            <option value="consultant">Consultant</option>
                        </select>
                        @if ($errors->has('doctor_type_for_patient'))
                            <span class="text-danger">{{ $errors->first('doctor_type_for_patient') }}</span>
                        @endif
                    </div>


                    <div class="form-group col-md-4">
                        <label>Admit Date</label>
                        <input type="date" name="admit_date" value="{{ old('admit_date') }}" class="form-control take_past_date">
                        @if ($errors->has('admit_date'))
                            <span class="text-danger">{{ $errors->first('admit_date') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label>Admit Time</label>
                        <input type="time" name="admit_time" value="{{ old('admit_time') }}" class="form-control">
                        @if ($errors->has('admit_time'))
                            <span class="text-danger">{{ $errors->first('admit_time') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label>Discharge Date</label>
                        <input type="date" name="discharge_date" value="{{ old('discharge_date') }}"
                               class="form-control take_future_date">
                        @if ($errors->has('discharge_date'))
                            <span class="text-danger">{{ $errors->first('discharge_date') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label>Discharge Time</label>
                        <input type="time" name="discharge_time" value="{{ old('discharge_time') }}"
                               class="form-control">
                        @if ($errors->has('discharge_time'))
                            <span class="text-danger">{{ $errors->first('discharge_time') }}</span>
                        @endif
                    </div>

                @endif
                @if(auth()->user()->organization->organization_type == 'clinic' || 'diagnostic')
                    <div class="form-group mb-20 d-block col-4 pt-5 mt-5 text-center">
                        <button type="submit" name="createBtn" id="createBtn" value="Save"
                                class="btn btn-success btn-block btn-lg">Save
                        </button>
                    </div>
                @endif
                @if(auth()->user()->organization->organization_type == 'hospital')
                    <div class="form-group mb-20 d-block  col-4 pt-5 mt-5 text-center">
                        <button type="submit" name="createBtn" id="createBtn" value="Save"
                                class="btn btn-success btn-block btn-lg">Save
                        </button>
                    </div>
                @endif
            </form>
        </div>
    </div>
    {{--    </div>--}}
    {{--</div>--}}
@endsection
@push('customScripts')
    <script>
        $("input[name*='attendee_name']").keyup(function () {
            let value_input = $("input[name*='attendee_name']").val();

            let regexp = /[^a-zA-Z. ]/g;
            if (value_input.match(regexp)) {
                $("input[name*='attendee_name']").val(value_input.replace(regexp, ''))
            }
        });
        $("input[name*='attendee_relation_with_patient']").keyup(function () {
            let value_input = $("input[name*='attendee_relation_with_patient']").val();

            let regexp = /[^a-zA-Z. ]/g;
            if (value_input.match(regexp)) {
                $("input[name*='attendee_relation_with_patient']").val(value_input.replace(regexp, ''))
            }
        });
    </script>
@endpush
