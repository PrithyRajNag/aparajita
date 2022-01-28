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
                        <label>Child Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                        <div id="update_name_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Gender:</label>
                        <select name="gender" id="gender" class="form-control">
                            <option  hidden></option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        <div id="update_gender_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Weight</label>
                        <input type="text" name="weight" min="0" id="weight" class="form-control" placeholder="Weight" required>
                        <div id="update_weight_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Blood Group:</label>
                        <select name="blood_group_id" id="blood_group_id" class="form-control">
                            <option  hidden></option>
                            @foreach($bloodGroups as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <div id="update_blood_group_id_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Date</label>
                        <input type="date" id="date" name="date" class="form-control take_past_date">
                        <div id="update_date_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Time</label>
                        <input type="time" id="time" name="time" class="form-control" >
                        <div id="update_time_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Mother Name</label>
                        <input type="text" name="mother_name" id="mother_name" class="form-control" placeholder="Mother Name">
                        <div id="update_mother_name_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Father Name</label>
                        <input type="text" name="father_name" id="father_name" class="form-control" placeholder="Father Name">
                        <div id="update_father_name_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Phone</label>
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
                        <label>Address</label>
                        <textarea type="text" name="address" id="note" class="form-control" placeholder="address"></textarea>
                        <div id="update_address_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Note</label>
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
