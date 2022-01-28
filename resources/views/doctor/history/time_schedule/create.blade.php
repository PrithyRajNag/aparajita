<div class="modal fade" id="addDoctorTimeSchedule">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title text-dark">Add New Doctor Time Schedule</h4>
                <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" action="" class="clearfix p-5" method="post" enctype="multipart/form-data" style="width: 100%; display: contents;">
                    <div class="form-group col-sm-12">
                        <label>Weekday</label>
                        <select name="patient" class="form-control">
                            <option value="1">Friday</option>
                            <option value="2">Saturday</option>
                            <option value="3">Sunday</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Start Time</label>
                        <input type="time" name="time" class="form-control" placeholder="Data">
                    </div>

                    <div class="form-group col-sm-12">
                        <label>End Time</label>
                        <input type="time" name="etime" class="form-control" placeholder="E-mail">
                    </div>

                    <div class="form-group mb-20 col-sm-6 offset-3">
                        <input type="submit" name="addDoctorTimeScheduleBtn" id="" value="Submit" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
