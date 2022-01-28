<div class="modal fade" id="edit">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light">Edit Now</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div id="error-msg" class="alert alert-danger"></div>
            <div class="modal-body row">
                <form role="form" id="editForm" action="" class="clearfix" method="post" enctype="multipart/form-data" style="width: 100%; display: contents;">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="id">

                    <div class="form-group col-sm-12">
                        <label>Bed Number</label>
                        <input type="text" name="bed_number" id="bed_number" class="form-control" placeholder="Bed Number" required>
                        <div id="update_bed_number_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Bed Type</label>
                        <select name="bed_type_id" id="bed_type_id" class="form-control">
                            <option  hidden></option>
                            @foreach($bedTypes as $bedType)
                                <option value="{{ $bedType->id }}">{{ $bedType->name }}</option>
                            @endforeach
                        </select>
                        <div id="update_bed_type_id_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Floor</label>
                        <input type="text" name="floor" id="floor" class="form-control" placeholder="Floor" required>
                        <div id="update_floor_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Description</label>
                        <input type="text" name="description" id="description" class="form-control" placeholder="Description">
                        <div id="update_description_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Charge</label>
                        <input type="text" name="price" id="price" class="form-control" placeholder="Charge">
                        <div id="update_price_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Availability</label>
                        <select name="is_available" id="is_available" class="form-control">
                            <option hidden>Select Availability</option>
                            <option id="available" value="1">Available</option>
                            <option id="not-available" value="0">Not Available</option>
                        </select>
                        <div id="update_is_available_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            <option hidden>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <div id="update_status_error" class="text-danger"></div>
                    </div>

                    <div class="form-group mb-20 col-md-4 offset-md-4">
                        <button type="submit" name="editBtn" id="editBtn" value="Update" class="btn btn-primary btn-block btn-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
