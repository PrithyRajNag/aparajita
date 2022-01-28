<div class="modal fade" id="editNot">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light">Edit Noties</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" action="" class="clearfix" method="post" style="width: 100%; display: contents;">
                    <div class="form-group col-md-6">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Title" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Description</label>
                        <textarea type="text" name="description" class="form-control" placeholder="Description" required rows="2"></textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Start Date</label>
                        <input type="date" name="data" class="form-control" placeholder="Data">
                    </div>

                    <div class="form-group col-md-6">
                        <label>End Date</label>
                        <input type="date" name="data" class="form-control" placeholder="Data">
                    </div>

                    <div class="form-group mt-5 col-md-4 offset-md-4">
                        <input type="submit" name="editNotBtn" id="" value="Update Not" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
