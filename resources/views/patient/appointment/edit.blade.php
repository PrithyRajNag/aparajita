@extends('layouts.master')
@section('content')
    <div class="modal-header bg-info">
        <h4 class="modal-title text-light">Edit Patient Appointment</h4>
    </div>

    <div class="modal-body row">
        <form role="form" id="editForm" action="{{route('patient.appointment.update', $data->id)}}" method="POST"
              class="clearfix" style="width: 100%; display: contents;">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="id">
            <input type="hidden" name="organization_id" id="organization_id">

            <div class="form-group col-md-4">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" placeholder="First Name"
                       value="{{ old('first_name', $data->patients->first_name) }}" required>
                @if ($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" placeholder="Last Name"
                       value="{{ old('last_name', $data->patients->last_name) }}" required>
                @if ($errors->has('last_name'))
                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label>Phone</label>
                <input type="text" name="phone_number" class="form-control" placeholder="+880"
                       value="{{ old('phone_number', $data->patients->phone_number) }}" required>
                @if ($errors->has('phone_number'))
                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label>Age</label>
                <input type="number" name="age" min="0" class="form-control" placeholder="Age"
                       value="{{ old('age', $data->patients->age) }}" required>
                @if ($errors->has('age'))
                    <span class="text-danger">{{ $errors->first('age') }}</span>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label>Date Of Birth</label>
                <input type="date" name="dob" class="form-control" value="{{ old('dob', $data->patients->dob) }}"
                       placeholder="Date Of Birth">
                @if ($errors->has('dob'))
                    <span class="text-danger">{{ $errors->first('dob') }}</span>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option hidden value="{{ old('gender', $data->patients->gender) }}"> {{ucwords($data->patients->gender)}}</option>
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
                    @foreach($bloodGroups as $item)
                        <option
                            value="{{ $item->id }}" {{$item->blood_group_id == $item->id  ? 'selected' : ''}}>{{ $item->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('blood_group_id'))
                    <span class="text-danger">{{ $errors->first('blood_group_id') }}</span>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label>Religion</label>
                <select name="religion" class="form-control">
                    <option hidden value="{{ old('religion', $data->patients->religion) }}">{{ucwords($data->patients->religion)}}</option>
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
                          placeholder="Address">{{ old('address', $data->patients->address) }}</textarea>
                @if ($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label>Doctor Name</label>
                <select name="doctor_id" id="doctor_id" class="form-control">
                    <option selected
                            value="{{ $data->doctor_id }}" hidden>{{ $data->doctors->full_name }}</option>
                    @foreach($doctors as $item)
                        <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('doctor_id'))
                    <span class="text-danger">{{ $errors->first('doctor_id') }}</span>
                @endif
            </div>


            <div class="form-group col-md-4">
                <label>Appointment Date</label>
                <input type="date" name="date" id="date" value="{{ old('date', $data->date) }}" class="form-control take_future_date">
                @if ($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label>Appointment Time</label>
                <input disabled value="{{ normalTimeFormat($data->start_time) . ' - ' .normalTimeFormat($data->end_time) }}" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <button type="button" name="slotBtn" id="slotBtn" value="Slots"
                        class="btn btn-primary btn-block">Slots
                </button>
            </div>

            <div id="error-msg" class="alert alert-danger col-md-12 text-center"></div>

            <div class="form-group col-md-12">
                <label id="appointment_label">Appointment Slots</label>
                <ul id="appointment_slots" class="appointment_slots"></ul>
            </div>

            <div class="form-group mb-20 offset-md-4 col-md-4 pt-5 mt-5">
                <button type="submit" name="createBtn" id="createBtn" value="Save"
                        class="btn btn-success btn-block btn-lg">Save
                </button>
            </div>

        </form>
    </div>
    </div>


@endsection
@push('customScripts')
    <script>
        $(function () {
            var doctor_id = $("#doctor_id").val();
            var date = $("#date").val();
            $.ajax({
                url: '/patient/appointment/slots',
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    date: date,
                    doctor_id: doctor_id
                },

                success: function (response) {
                    console.log('getting response')
                    if (response) {
                        $('#appointment_label').show();
                        $('.slots').remove()
                        // console.table(response);
                        console.log(appointment_slots)
                        // response.forEach(item){
                        //     console.log(item)
                        // }
                        console.log(response)
                        // console.log(response[2][0])
                        console.log('Loop starts')
                        for (i = 0; i < response.length; i++) {
                            console.log(response[i])
                            var is_disabled = (response[i].is_booked != false) ? 'disabled' : ''
                            var slot = '<li class="slots"><input type="radio" id="time' + i + '" name="time" value="' + response[i].slot + '" ' + is_disabled + ' /><label for="time' + i + '">' + response[i].slot + '</label></li>'
                            $('#appointment_slots').append(slot)
                        }
                    }
                },
                error: function (xhr, status, error) {
                    let errors = JSON.parse(xhr.responseText);
                    if (!errors.hasOwnProperty("errors")) {
                        $("#error-msg").text("Doctor Doesn't Have Any Schedule That Day.");
                        // $('#editBtn').attr('disabled', true);
                        return;
                    }
                },
                // dataType : 'json'
            });

        });

        // $(function () {
        $('#slotBtn').on('click', function () {

            console.log('Entered')
            var doctor_id = $("#doctor_id").val();
            var date = $("#date").val();
            $.ajax({
                url: '/patient/appointment/slots',
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    date: date,
                    doctor_id: doctor_id
                },

                success: function (response) {
                    console.log('getting response')
                    if (response) {
                        $("#error-msg").hide();
                        $('#appointment_label').show();
                        $('.slots').remove()
                        for (i = 0; i < response.length; i++) {
                            console.log(response[i])
                            var is_disabled = (response[i].is_booked != false) ? 'disabled' : ''
                            var slot = '<li class="slots"><input type="radio" id="time' + i + '" name="time" value="' + response[i].slot + '" ' + is_disabled + ' /><label for="time' + i + '">' + response[i].slot + '</label></li>'
                            $('#appointment_slots').append(slot)
                            // var slot = '<li class="slots"><input type="radio" id="time'+ i +'" name="time" value="'+ response[i].slot +'" /><label for="time'+ i +'">' + response[i].slot + '</label></li>'
                            // $('#appointment_slots').append(slot)
                        }
                    }
                },
                error: function (xhr, status, error) {
                    let errors = JSON.parse(xhr.responseText);
                    if (!errors.hasOwnProperty("errors")) {
                        $('#appointment_label').hide();
                        $('.slots').remove();
                        $("#error-msg").text("Doctor Doesn't Have Any Schedule That Day.");
                        return;
                    }
                },
                // dataType : 'json'
            });
        });
        // });
    </script>
@endpush
