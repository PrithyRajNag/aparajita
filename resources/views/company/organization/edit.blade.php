@extends('com_layouts.master')
@section('comContent')
    <!-- Start Edit Organization Model -->
    <div class="row justify-content-start">
        <div class="col-sm-12">
            <div class="card">
                <h4 class="card-header bg-transparent d-flex justify-content-between">
                    <span class="text-dark align-self-center">Edit Organization</span>
                </h4>
                <div class="row card-body f-16">
                    <form role="form" class="clearfix" id="editForm"
                          action="{{route('company.organization.update', $data->id)}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if($errors->any())            {!! implode('', $errors->all('<div>:message</div>')) !!}
                                               @endif
                        <div class="d-flex">
                            <div class="row">
                            <div class="col-sm-9">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label font-weight-bold">Organization Name:</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="organization_name" class="form-control"
                                               value="{{ old('organization_name', $data->organization->name) }}"
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
                                                    value="{{ $data->organization->organization_type }}"> {{ ucwords($data->organization->organization_type) }} </option>
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
                                          rows="2">{{ old('organization_address', $data->organization->address) }}</textarea>
                                    </div>
                                    @if ($errors->has('organization_address'))
                                        <span class="text-danger">{{ $errors->first('organization_address') }}</span>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label font-weight-bold">Owner First Name:</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $data->first_name) }}" placeholder="Owner First Name">
                                    </div>
                                    @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label font-weight-bold">Owner Last Name:</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $data->last_name) }}" placeholder="Owner Last Name">
                                    </div>
                                    @if ($errors->has('last_name'))
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label font-weight-bold">Email Address:</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="email" class="form-control"
                                               value="{{ old('email', $data->email) }}" placeholder="Email">
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label font-weight-bold">Mobile No:</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="phone_number"
                                               value="{{ old('phone_number', $data->phone_number) }}" class="form-control"
                                               placeholder="Number">
                                    </div>
                                    @if ($errors->has('phone_number'))
                                        <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label font-weight-bold">Date Of Birth:</label>
                                    <div class="col-sm-6">
                                        <input type="date" name="dob" value="{{ old('dob', $data->dob) }}" class="form-control"
                                               placeholder="Date Of Birth">
                                    </div>
                                    @if ($errors->has('dob'))
                                        <span class="text-danger">{{ $errors->first('dob') }}</span>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label font-weight-bold">Blood Group:</label>
                                    <div class="col-sm-6">
                                        <select name="blood_group_id" class="form-control">
                                            <option value="{{ old('blood_group_id', $data->blood_group_id) }}"
                                                    hidden>{{ $data->bloodGroups->name }}</option>
                                            @foreach($bloodGroups as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('blood_group_id'))
                                            <span class="text-danger">{{ $errors->first('blood_group_id') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label font-weight-bold">Gender:</label>
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <label for="male">
                                                <input type="radio" id="gender" name="gender"
                                                       {{ $data->gender == "male" ? "checked" : "" }} value="male">
                                                <span class="mr-sm-2 mt-0">Male</span>
                                            </label>
                                            <label for="female">
                                                <input type="radio" id="gender" name="gender"
                                                       {{ $data->gender == "female" ? "checked" : "" }} value="female">
                                                <span class="mr-sm-2">Female</span>
                                            </label>
                                            <label for="other">
                                                <input type="radio" id="gender" name="gender"
                                                       {{ $data->gender == "other" ? "checked" : "" }} value="other">
                                                <span class="mr-sm-2">Other</span>
                                            </label>
                                        </div>
                                        @if ($errors->has('gender'))
                                            <span class="text-danger">{{ $errors->first('gender') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label font-weight-bold">National Id:</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="nid" value="{{ old('nid', $data->nid) }}" class="form-control"
                                               placeholder="National Id Number">
                                    </div>
                                    @if ($errors->has('nid'))
                                        <span class="text-danger">{{ $errors->first('nid') }}</span>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label font-weight-bold">Owner Address:</label>
                                    <div class="col-sm-6">
                                <textarea type="text" name="address" class="form-control" placeholder="Address"
                                          rows="2">{{ $data->address }}</textarea>
                                    </div>
                                    @if ($errors->has('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label font-weight-bold">One Time Purchase:</label>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_one_time_purchase"
                                                   {{ ($data->organization->is_one_time_purchase) ? 'checked' : '' }} value="1">
                                            <label class="form-check-label">YES</label>
                                        </div>
                                    </div>
                                    @if ($errors->has('is_one_time_purchase'))
                                        <span class="text-danger">{{ $errors->first('is_one_time_purchase') }}</span>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label font-weight-bold">Monthly Bill:</label>
                                    <div class="col-sm-6">
                                        <input type="number" name="monthly_bill"
                                               value="{{ old('monthly_bills', $data->organization->monthly_bill) }}"
                                               class="form-control"
                                               placeholder="Monthly Bill">
                                    </div>
                                    @if ($errors->has('monthly_bill'))
                                        <span class="text-danger">{{ $errors->first('monthly_bill') }}</span>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label font-weight-bold">Logo:</label>
                                    <div class="input-group col-sm-6">
                                        <div class="custom-file">
                                            <input type="file" name="logo" id="logo" value="{{ old('logo', $data->organization->logo) }}"/>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <div id="image-holder" style="width: 200px; position: relative"></div>
                                        </div>
                                    </div>
                                    @if ($errors->has('logo'))
                                        <span class="text-danger">{{ $errors->first('logo') }}</span>
                                    @endif
                                </div>
                            </div>
                                <div class="col-sm-3">
                                    @if($data->organization->logo != null)
                                            <img src="{{asset('storage/uploads/'.$data->organization->logo)}}" class="img-thumbnail" width="100%" >
                                    @endif
                                </div>
                            </div>
                        </div>





                        <div class="col-sm-12 form-group">
                            <label class="font-weight-bold">Module Permission:</label>
                            @foreach($modules as $item)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                           {{ in_array( $item->id, $data->organization->organizationModules->pluck('id')->toArray())  ? 'checked' : '' }} name="modules[]"
                                           value="{{ $item->id }}">
                                    <label class="form-check-label">{{ $item->name }}</label>
                                </div>
                            @endforeach
                            @if ($errors->has('modules'))
                                <span class="text-danger">{{ $errors->first('modules') }}</span>
                            @endif
                        </div>

                        {{--                    @dd($data->organization->organizationModules->pluck('id'))--}}
                        {{--                    @dd(in_array( 1, $data->organization->organizationModules->pluck('id')->toArray() ) )--}}


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
    <!-- End New Organization Model -->
@endsection
@push('comCustomScripts')
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
