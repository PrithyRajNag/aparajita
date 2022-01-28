@extends('layouts.master')
@section('content')
    <!-- Start Admin Setting Model Area -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            @if(session('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('success') }}
                </div>
            @endif
            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center font-weight-normal">Settings</span>
                </h4>
                <div class="card-body font-weight-normal row">
                    <form role="form" class="clearfix" id="editForm"
                          action="{{route('setting.update', $data->id)}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if($errors->any())            {!! implode('', $errors->all('<div>:message</div>')) !!}
                        @endif
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Organization Name:</label>
                            <div class="col-sm-6">
                                <input type="text" name="organization_name" class="form-control"
                                       value="{{ old('organization_name', $data->name) }}"
                                       placeholder="Organization Name">
                            </div>
                            @if ($errors->has('organization_name'))
                                <span class="text-danger">{{ $errors->first('organization_name') }}</span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Organization Type:</label>
                            <div class="col-sm-6">
                                <select name="organization_type" class="form-control">
                                    <option hidden
                                            value="{{ $data->organization_type }}"> {{ ucwords($data->organization_type) }} </option>
                                    <option value="hospital">Hospital</option>
                                    <option value="clinic">Clinic</option>
                                    <option value="diagnostic">Diagnostic Center</option>
                                </select>
                                @if ($errors->has('organization_type'))
                                    <span class="text-danger">{{ $errors->first('organization_type') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Organization Address:</label>
                            <div class="col-sm-6">
                                <textarea type="text" name="organization_address" class="form-control"
                                          placeholder="Address"
                                          rows="2">{{ old('organization_address', $data->address) }}</textarea>
                            </div>
                            @if ($errors->has('organization_address'))
                                <span class="text-danger">{{ $errors->first('organization_address') }}</span>
                            @endif
                        </div>


{{--                        <div class="col-3">--}}
{{--                            @if($data->logo != null)--}}
{{--                                --}}
{{--                                <img src="{{asset('storage/uploads/'.$data->logo)}}" class="img-thumbnail" width="100%">--}}
{{--                            @endif--}}
{{--                        </div>--}}
                        @if($data->logo != null)
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Logo:</label>
                            <div class="col-2">
                                <img src="{{asset('storage/uploads/'.$data->logo)}}" class="img-thumbnail" width="100%">
                            </div>
                            @if ($errors->has('logo'))
                                <span class="text-danger">{{ $errors->first('logo') }}</span>
                            @endif
                        </div>
                        @endif

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Replace Logo:</label>
                            <div class="input-group col-sm-8">
                                <div class="custom-file">
                                    <input type="file" name="logo" id="logo" value="{{ old('logo', $data->logo) }}"/>
                                </div>
                                <div class="form-group col-sm-6">
                                    <div id="image-holder" style="width: 200px; position: relative"></div>
                                </div>
                            </div>
                            @if ($errors->has('logo'))
                                <span class="text-danger">{{ $errors->first('logo') }}</span>
                            @endif
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
    <!-- End Admin Setting Model Area -->
@endsection
@push('customScripts')
    <script>
        $("#logo").on('change', function () {
            var imgPath = $(this)[0].value;
            var extension = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (extension === "gif" || extension === "png" || extension === "jpg" || extension === "jpeg" || extension === "svg") {
                if (typeof (FileReader) != "undefined") {

                    var image_holder = $("#image-holder");
                    image_holder.empty();

                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "img-thumbnail"
                        }).appendTo(image_holder);
                    };
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            } else {
                alert("Please Select Image Only !");
            }
        });
    </script>
@endpush
