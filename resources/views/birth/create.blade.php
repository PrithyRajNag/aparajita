<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Add</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="createForm" action="{{route('birth.store')}}  class="clearfix" method="POST" enctype="multipart/form-data" style="width: 100%; display: contents;">

                    @csrf
                    <div class="form-group col-md-6">
                        <label>Child Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                        <div id="name_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Gender:</label>
                        <select name="gender" class="form-control">
                            <option  hidden></option>
                            <option  value="male">Male</option>
                            <option  value="female">Female</option>
                            <option  value="other">Other</option>
                        </select>
                        <div id="gender_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Weight</label>
                        <input type="text" name="weight" min="0" class="form-control" placeholder="Weight(lb)" required>
                        <div id="weight_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Blood Group:</label>
                        <select name="blood_group_id" class="form-control">
                                <option  hidden></option>
                                @foreach($bloodGroups as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                       </select>
                        <div id="blood_group_id_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control take_past_date">
                        <div id="date_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Time</label>
                        <input type="time" name="time" class="form-control">
                        <div id="time_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Mother Name</label>
                        <input type="text" name="mother_name" class="form-control" placeholder="Mother Name">
                        <div id="mother_name_error" class="text-danger"></div>
                    </div>

                <div class="form-group col-md-6">
                        <label>Father Name</label>
                        <input type="text" name="father_name" class="form-control" placeholder="Father Name">
                        <div id="father_name_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Phone</label>
                        <input type="text" name="phone_number" class="form-control" placeholder="+880" >
                        <div id="phone_number_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Doctor Name</label>
                        <select name="doctor_id" class="form-control">
                        <option  hidden></option>
                            @foreach($doctors as $item)
                                <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                            @endforeach
                        </select>
                        <div id="doctor_id_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Address</label>
                        <textarea type="text" name="address" class="form-control" placeholder="Address"></textarea>
                        <div id="address_error" class="text-danger"></div>
                    </div>
                <div class="form-group col-md-6">
                        <label>Note</label>
                        <textarea type="text" name="note" class="form-control" placeholder="Note"></textarea>
                        <div id="note_error" class="text-danger"></div>
                    </div>

                    <div class="form-group mt-5 col-md-4 offset-md-4">
                        <input type="submit" name="createBtn" id="createBtn" value="Save" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
