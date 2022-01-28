<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Add New</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="createForm" class="clearfix" method="post" enctype="multipart/form-data" style="width: 100%; display: contents;">
                    @csrf
                    <div class="form-group col-md-4">
                        <label>Vehicle Number</label>
                        <input type="text" name="vehicle_number" class="form-control" placeholder="Vehicle Number" required>
                        <div id="vehicle_number_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Vehicle Model</label>
                        <input type="text" name="vehicle_model" class="form-control" placeholder="Vehicle Model" required>
                        <div id="model_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Driver Name</label>
                        <input type="text" name="driver_name" class="form-control" placeholder="Name">
                        <div id="driver_name_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Driver License</label>
                        <input type="text" name="driver_license" class="form-control" placeholder="License No">
                        <div id="license_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Driver Contact</label>
                        <input type="text" name="driver_phone_number" class="form-control" placeholder="Phone No">
                        <div id="driver_number_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Address</label>
                        <input type="text" name="driver_address" class="form-control" placeholder="Address">
                        <div id="driver_address_error" class="text-danger"></div>
                    </div>

                    <div class="form-group mb-20 col-md-4 offset-md-4">
                        <input type="submit" name="createBtn" id="createBtn" value="Save" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
