<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Add New Module</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="createForm" class="clearfix" method="post" style="width: 100%; display: contents;">
                    @csrf
                    <div class="form-group col-sm-6">
                        <label>Module Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Module Name" required>
                        <div id="name_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Remarks</label>
                        <textarea type="text" name="note" class="form-control" placeholder="Remarks" rows="2"></textarea>
                        <div id="note_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            @include('layouts.partials.statusDropdown')
                        </select>
                        <div id="status_error" class="text-danger"></div>
                    </div>
                    <div class="form-group mt-5 col-md-4 offset-md-4">
                        <input type="submit" name="createBtn" id="createBtn" value="Save" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
