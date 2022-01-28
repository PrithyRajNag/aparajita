<div class="modal fade" id="edit">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light">Edit Module</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="editForm" action="#" class="clearfix" method="post" style="width: 100%; display: contents;">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="id">

                    <div class="form-group col-md-6">
                        <label>Module Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Module Name" required>
                        <div id="update_name_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Remarks</label>
                        <textarea type="text" name="note" id="note" class="form-control" placeholder="Remarks" rows="2"></textarea>
                        <div id="update_note_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            @include('layouts.partials.statusDropdown')
                        </select>
                    </div>
                    <div class="form-group mt-5 col-md-4 offset-md-4">
                        <button type="submit" name="editBtn" id="editBtn" value="Update" class="btn btn-primary btn-block btn-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
