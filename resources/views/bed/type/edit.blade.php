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
                        <label>Bed Type</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                        <div id="update_name_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            @include('layouts.partials.statusDropdown')
                        </select>
                        <div id="update_status_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Description</label>
                        <input type="text" name="description" id="description" class="form-control" placeholder="Description">
                        <div id="update_description_error" class="text-danger"></div>
                    </div>

                    <div class="form-group mb-20 col-md-4 offset-md-4">
                        <button type="submit" name="editBtn" id="editBtn" value="Update" class="btn btn-primary btn-block btn-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
