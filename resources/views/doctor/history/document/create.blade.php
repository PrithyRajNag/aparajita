{{--@extends('layouts.master')--}}
{{--@section('content')--}}
    {{--    <div class="modal fade" id="addPatient">--}}
    {{--    <div class=" modal-lg modal-dialog-centered">--}}
    {{--<div class="modal-content">--}}
        {{--<div class="modal-header bg-light">--}}
            {{--<h4 class="modal-title text-dark">Upload Document</h4>--}}
            {{--<button type="button" class="close text-dark" data-dismiss="modal">&times;</button>--}}
        {{--</div>--}}
        {{--<div class="modal-body row">--}}
            {{--<form role="form" action="{{route('doctor.history.save', request()->segment(2) )}}" class="clearfix" method="post" enctype="multipart/form-data"--}}
                  {{--style="width: 100%; display: contents;">--}}
                {{--@csrf--}}
                {{--<div class="form-group col-sm-12">--}}
                    {{--<label>Title</label>--}}
                    {{--<input type="text" name="title" class="form-control" placeholder="Title">--}}
                {{--</div>--}}

                {{--<div class="form-group col-sm-12">--}}
                    {{--<label>File</label>--}}
                    {{--<input type="file" name="cover" class="form-control-file" placeholder="File">--}}
                {{--</div>--}}

                {{--<div class="form-group mb-20 col-sm-6 offset-3">--}}
                    {{--<input type="submit" name="createBtn" id="" value="Upload"--}}
                           {{--class="btn btn-success btn-block btn-lg">--}}
                {{--</div>--}}
            {{--</form>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--    </div>--}}
    {{--</div>--}}
{{--@endsection--}}



@extends('layouts.master')
@section('content')
    {{--<div class="modal fade" id="addDoctorDocument">--}}
        {{--<div class="modal-dialog modal-dialog-centered">--}}
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title text-dark">Upload Document</h4>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body row">
                    <form role="form" action="{{route('doctor.history.save', request()->segment(2) )}}" class="clearfix" method="post" enctype="multipart/form-data"
                          style="width: 100%; display: contents;">
                        @csrf
                        <div class="form-group col-sm-12">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Title">
                            @if ($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-sm-12">
                            <label>File</label>
                            <input type="file" name="cover" class="form-control-file" placeholder="File">
                            @if ($errors->has('cover'))
                                <span class="text-danger">{{ $errors->first('cover') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-20 col-sm-6 offset-3">
                            <input type="submit" name="createBtn" id="" value="Upload"
                                   class="btn btn-success btn-block btn-lg">
                        </div>
                    </form>
                </div>
            </div>
        {{--</div>--}}
    {{--</div>--}}
@endsection
