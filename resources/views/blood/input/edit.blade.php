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
                        <label>First Name : </label>
                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name">
                        <div id="update_first_name_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Last Name : </label>
                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name">
                        <div id="update_last_name_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Age : </label>
                        <input type="number" name="age" id="age" class="form-control" placeholder="Age">
                        <div id="update_age_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Gender : </label>
                        <select name="gender" id="gender" class="form-control">
                            <option  hidden>{{ucwords('')}}</option>
                            <option  value="male">Male</option>
                            <option  value="female">Female</option>
                            <option  value="other">Other</option>
                        </select>
                        <div id="update_gender_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Date : </label>
                        <input type="date" name="date" id="date" class="form-control" placeholder="Date">
                        <div id="update_date_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Blood Group : </label>
                        <select name="blood_group_id" id="blood_group_id" class="form-control">
                            <option  hidden></option>
                            @foreach($bloodGroups as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <div id="update_blood_group_id_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Phone : </label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="+880" >
                        <div id="update_phone_number_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Regular Donor : </label>
                        <select name="is_regular_donor" id="is_regular_donor" class="form-control">
                            <option  hidden></option>
                            <option  value="1">Yes</option>
                            <option  value="0">No</option>
                        </select>
                        <div id="update_gender_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Bag Number : </label>
                        <input type="text" name="bag_number" id="bag_number" class="form-control" placeholder="Bag Number" >
                        <div id="update_bag_number_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Address : </label>
                        <textarea type="text" name="address" id="address" class="form-control" placeholder="Address"></textarea>
                        <div id="update_address_error" class="text-danger"></div>
                    </div>

                    <div class="form-group mt-5 col-md-4 offset-md-4">
                        <button type="submit" name="editBtn" id="editBtn" value="Update" class="btn btn-primary btn-block btn-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
