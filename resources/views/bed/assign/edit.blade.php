<div class="modal fade" id="edit">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light">Edit Now</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="editForm" action="" class="clearfix" method="post" enctype="multipart/form-data" style="width: 100%; display: contents;">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="id">

                    <div class="form-group col-sm-12">
                        <label>Select Patient</label>
                        <select name="patient_id" id="patient_id" class="form-control">
                            <option  hidden></option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->full_name }}</option>
                            @endforeach
                            <div id="update_patient_id_error" class="text-danger"></div>
                        </select>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Bed Type</label>
                        <select name="bed_type_id" id="bed_type_id" class="form-control">
{{--                            <option  hidden></option>--}}
                            @foreach($bedTypes as $bedType)
                                <option value="{{ $bedType->id }}">{{ $bedType->name }}</option>
                            @endforeach
                        </select>
                        <div id="update_bed_type_id_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Bed Number</label>
                        <select name="bed_list_id" id="bed_list_id" class="form-control">
                            @foreach($bedList as $item)
                                <option value="{{ $item->id }}">{{ $item->bed_number }}</option>
                            @endforeach
                        </select>
                        <div id="update_bed_list_id_error" class="text-danger"></div>
                    </div>



{{--                    <div class="form-group col-sm-12">--}}
{{--                        <label>Floor</label>--}}
{{--                        <input type="text" name="floor" id="floor" class="form-control" placeholder="Floor" required>--}}
{{--                        <div id="update_floor_error" class="text-danger"></div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group col-sm-12">--}}
{{--                        <label>Description</label>--}}
{{--                        <input type="text" name="description" id="description" class="form-control" placeholder="Description">--}}
{{--                        <div id="update_description_error" class="text-danger"></div>--}}
{{--                    </div>--}}

{{--                    <div class="form-group col-sm-12">--}}
{{--                        <label>Price</label>--}}
{{--                        <input type="text" name="price" id="price" class="form-control" placeholder="Charge">--}}
{{--                        <div id="update_price_error" class="text-danger"></div>--}}
{{--                    </div>--}}

                    <div class="form-group col-sm-6">
                        <label>Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Date">
                        <div id="update_start_date_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" placeholder="Date">
                        <div id="update_end_date_error" class="text-danger"></div>
                    </div>

{{--                    <div class="form-group col-sm-6">--}}
{{--                        <label>Status</label>--}}
{{--                        <select name="status" class="form-control">--}}
{{--                            @include('layouts.partials.statusDropdown')--}}
{{--                        </select>--}}
{{--                        <div id="update_status_error" class="text-danger"></div>--}}
{{--                    </div>--}}

                    <div class="form-group mb-20 col-md-4 offset-md-4">
                        <input type="submit" name="editBtn" id="editBtn" value="Update" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
