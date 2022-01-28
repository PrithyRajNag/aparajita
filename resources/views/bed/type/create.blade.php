<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Add Now</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="createForm" class="clearfix" method="POST" enctype="multipart/form-data" style="width: 100%; display: contents;">
                    @csrf
                    <div class="form-group col-sm-12">
                        <label>Bed Type</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                        <div id="name_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            @include('layouts.partials.statusDropdown')
                        </select>
                        <div id="status_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Description</label>
                        <input type="text" name="description" class="form-control" placeholder="Description">
                        <div id="description_error" class="text-danger"></div>
                    </div>

                    <div class="form-group mb-20 col-sm-4 offset-sm-4">
                        <input type="submit" name="createBtn" id="createBtn" value="Save" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
