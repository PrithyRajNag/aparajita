@extends('layouts.master')
@section('content')
    {{--<div class="modal fade" id="add">--}}
    {{--    <div class="modal-dialog modal-dialog-centered">--}}
    {{--        <div class="modal-content">--}}
    <div class=" bg-info">
        <h4 class="modal-title text-light">Edit Doctor Schedule</h4>
        {{--                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>--}}
    </div>
    <div class="modal-body row">
        <form role="form" method="POST" id="editForm" action="{{route('doctor.all-doctors.schedule.update', $data->id)}}"  style="width: 100%; display: contents;">
            @csrf
            @method('PUT')
            <input type="hidden" name="organization_id" id="organization_id">

            <div class="form-group col-md-12">
                <label>Doctor Name</label>
                <select name="doctor_id" class="form-control" id="doctor_id">
                    <option  hidden value="{{ old('doctor_id',$data->doctors->id) }}">{{ $data->doctors->full_name }}</option>
                    @foreach($doctors as $item)
                        <option value="{{ $item->id }}" {{$item->doctor_id == $item->id  ? 'selected' : ''}}>{{ $item->full_name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('doctor_id'))
                    <span class="text-danger">{{ $errors->first('doctor_id') }}</span>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label>Select Day</label>
                {{--                        <input type="text" id="days" />--}}
                <select class="form-control" name="week_day" id="week_day">
                    <option  hidden value="{{ old('week_day', $data->week_day) }}"> {{ucwords($data->week_day)}}</option>
                    <option value="saturday">Saturday</option>
                    <option value="sunday">Sunday</option>
                    <option value="monday">Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
                    <option value="friday">Friday</option>
                </select>
                @if ($errors->has('week_day'))
                    <span class="text-danger">{{ $errors->first('week_day') }}</span>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label>Patient Limit</label>
                <input type="number" name="patient_limit" value="{{ old('patient_limit', $data->patient_limit) }}" id="patient_limit" class="form-control">
                @if ($errors->has('patient_limit'))
                    <span class="text-danger">{{ $errors->first('patient_limit') }}</span>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label>Start Time</label>
                <input type="time" name="start_time" id="start_time" value="{{ old('start_time', $data->start_time) }}" class="form-control">
                @if ($errors->has('start_time'))
                    <span class="text-danger">{{ $errors->first('start_time') }}</span>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label>End Time</label>
                <input type="time" name="end_time" id="end_time" value="{{ old('end_time', $data->end_time) }}" class="form-control">
                @if ($errors->has('end_time'))
                    <span class="text-danger">{{ $errors->first('end_time') }}</span>
                @endif
            </div>




            <div class="form-group mb-20 col-sm-4 offset-4">
                <button type="submit" name="editBtn" id="editBtn" value="Update" class="btn btn-primary btn-block btn-lg">Update</button>
            </div>
        </form>
    </div>
    {{--        </div>--}}
    {{--    </div>--}}
    {{--</div>--}}
@endsection
