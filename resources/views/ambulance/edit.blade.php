<div class="modal fade" id="edit">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light">Edit Now</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div id="error-msg" class="alert alert-danger"></div>
            <div class="modal-body row">
                <form role="form" id="editForm" action="#" class="clearfix" method="post" enctype="multipart/form-data" style="width: 100%; display: contents;">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="id">

                    <div class="form-group col-md-4">
                        <label>Vehicle Number</label>
                        <input type="text" name="vehicle_number" id="vehicle_number" class="form-control" placeholder="Name" required>
                        <div id="update_vehicle_number_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Vehicle Model</label>
                        <input type="text" name="vehicle_model" id="vehicle_model" class="form-control" placeholder="+880" required>
                        <div id="update_model_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Driver Name</label>
                        <input type="text" name="driver_name" id="driver_name" class="form-control" placeholder="Name">
                        <div id="update_driver_name_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Driver License</label>
                        <input type="text" name="driver_license" id="driver_license" class="form-control" placeholder="License">
                        <div id="update_license_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Driver Contact</label>
                        <input type="text" name="driver_phone_number" id="driver_phone_number" class="form-control" placeholder="Contact">
                        <div id="update_driver_number_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Address</label>
                        <input type="text" name="driver_address" id="driver_address" class="form-control" placeholder="Address">
                        <div id="update_driver_address_error" class="text-danger"></div>
                    </div>

                    <div class="form-group mb-20 col-md-4 offset-md-4">
                        <button type="submit" name="editBtn" id="editBtn" value="Update" class="btn btn-primary btn-block btn-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

