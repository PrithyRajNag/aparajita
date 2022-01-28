<!-- Start Edit Accounts Cost Model -->
<div class="modal fade" id="editAccounts">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light">Edit Accounts Cost</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" action="" class="clearfix" method="post" enctype="multipart/form-data" style="width: 100%; display: contents;">
                    <div class="form-group col-sm-12">
                        <label>Bill Type/Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Bill Type/Name" required>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Total Pay</label>
                        <input type="number" name="pay" class="form-control" placeholder="Total Pay" autocomplete="off">
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Details</label>
                        <textarea type="text" name="details" class="form-control" placeholder="Please input your bill details....." rows="2"></textarea>
                    </div>

                    <div class="form-group mt-3 col-sm-4 offset-sm-4">
                        <input type="submit" name="editDonor" id="editDonorBtn" value="Add Donor" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Edit Accounts Cost Model -->
