<div class="modal fade" id="edit">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light">Edit Now</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div id="error-msg" class="alert alert-danger"></div>
            <div class="modal-body row">
                <form role="form" id="editForm" action="#" class="clearfix" method="post" style="width: 100%; display: contents;">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="organization_id" id="organization_id">


                    <div class="form-group col-md-6">
                        <label>Patient Name</label>
                        <select name="patient_id" id="patient_id" class="form-control">
                            <option  hidden></option>
                            @foreach($patients as $item)
                                <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                            @endforeach
                        </select>
                        <div id="update_patient_id_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Date</label>
                        <input type="date" id="date" name="date" class="form-control take_past_date">
                        <div id="update_date_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Time</label>
                        <input type="time" id="time" name="time" class="form-control" step="1">
                        <div id="update_time_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Receiver's Contact</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="+880" >
                        <div id="update_phone_number_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Doctor Name</label>
                        <select name="doctor_id" id="doctor_id" class="form-control">
                            <option  hidden></option>
                            @foreach($doctors as $item)
                                <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                            @endforeach
                        </select>
                        </select>
                        <div id="update_doctor_id_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Reason</label>
                        <textarea type="text" name="note" id="note" class="form-control" placeholder="Note"></textarea>
                        <div id="update_note_error" class="text-danger"></div>
                    </div>

                    <div class="form-group mt-5 col-md-4 offset-md-4">
                        <button type="submit" name="editBtn" id="editBtn" value="Update" class="btn btn-primary btn-block btn-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
