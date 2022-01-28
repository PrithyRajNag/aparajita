<div class="modal fade" id="editAppointmentsHistory">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title text-dark">Update Appointments</h4>
                <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" action="" class="clearfix" method="post" enctype="multipart/form-data" style="width: 100%; display: contents;">
                    <div class="form-group col-sm-6">
                        <label>patient</label>
                        <select name="patient" class="form-control">
                            <option value="1">Rony(ID001)</option>
                            <option value="2">Micd(ID002)</option>
                            <option value="3">Abcd(ID003)</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Select Doctors</label>
                        <select name="doctor" class="form-control">
                            <option value="" disabled >Withdraw Type Select........</option>
                            <option value="1">Ms.Xxx</option>
                            <option value="2">Ms.Yyy</option>
                            <option value="3">Mrs.Zzz</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Date</label>
                        <input type="date" name="data" class="form-control" placeholder="Data">
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Available Slots</label>
                        <input type="time" name="time" class="form-control" placeholder="E-mail">
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Complete</option>
                            <option value="2">Not Complete</option>
                            <option value="3">Mrs.Zzz</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Remarks</label>
                        <textarea type="text" name="remarks" class="form-control" placeholder="Address" rows="2"></textarea>
                    </div>

                    <div class="form-group col-sm-12">
                        <input type="checkbox" name="sms">
                        <label>Send SMS</label>
                    </div>

                    <div class="form-group mb-20 col-sm-6 offset-3">
                        <input type="submit" name="editAppointmentsHistoryBtn" id="" value="Update" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
