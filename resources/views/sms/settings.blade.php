<div class="modal fade" id="addSmsSetting">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light">SMS Settings</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" action="" class="clearfix" method="post" style="width: 100%; display: contents;">
                    <div class="form-group col-sm-12">
                        <label>Clickatell User</label>
                        <input type="user" name="user" class="form-control" placeholder="Clickatell User ID" required>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Clickatell Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Clickatell Api Id</label>
                        <input type="api" name="api" class="form-control" placeholder="[YOUR CLICKATELL API ID]" required>
                    </div>

                    <div class="form-group mt-3 col-sm-6 offset-sm-3">
                        <input type="submit" name="editSMSSettingBtn" id="" value="Sava" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
