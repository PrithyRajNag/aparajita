<div class="modal fade" id="addDonor">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Add New</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="createForm" action="" class="clearfix" method="post" enctype="multipart/form-data" style="width: 100%; display: contents;">
                    <div class="form-group col-sm-6">
                        <label>Donor Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Blood Group</label>
                        <select name="num" class="form-control">
                            <option value="" disabled >Select Your Blood Group........</option>
                            <option value="1">A+</option>
                            <option value="2">A-</option>
                            <option value="3">B+</option>
                            <option value="4">B-</option>
                            <option value="5">O+</option>
                            <option value="6">O-</option>
                            <option value="7">AB</option>
                            <option value="8">AB+</option>
                            <option value="9">AB-</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="" disabled >Withdraw Type Select........</option>
                            <option value="1">Mam</option>
                            <option value="2">Woman</option>
                            <option value="3">Other</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Age</label>
                        <input type="date" name="age" class="form-control" placeholder="Age" autocomplete="off">
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Last Donation Date</label>
                        <input type="date" name="data" class="form-control" placeholder="Data">
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" placeholder="+880" required>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="admin@admin.com">
                    </div>

                    <div class="form-group mt-3 col-sm-4 offset-sm-4">
                        <input type="submit" name="createBtn" id="createBtn" value="Submit" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
