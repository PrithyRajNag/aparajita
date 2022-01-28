<div class="modal fade" id="edit">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Edit Now</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="editForm" action="#" class="clearfix" method="post" style="width: 100%; display: contents;">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="organization_id" id="organization_id">

                    <div class="form-group col-md-6">
                        <label>Name : </label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                        <div id="update_name_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Date : </label>
                        <input type="date" name="date" id="date" class="form-control" placeholder="Date">
                        <div id="update_date_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Blood Group : </label>
                        <select name="blood_group_id" id="blood_group_id" class="form-control">
                            @foreach($bloodGroups as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <div id="update_blood_group_id_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Bag Number : </label>
                        <select name="blood_collection_id" id="blood_collection_id" class="form-control">
{{--                            @foreach($availableBlood as $item)--}}
{{--                                <option value="{{ $item->id }}">{{ $item->bag_number }}</option>--}}
{{--                            @endforeach--}}
                        </select>
                        <div id="update_blood_collection_id_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Phone : </label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="+880" >
                        <div id="update_phone_number_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Blood For Our Patient  ? </label>
                        <select name="is_patient" id="is_patient" class="form-control">
                            <option  hidden></option>
                            <option  value="1">Yes</option>
                            <option  value="0">NO</option>
                        </select>
                        <div id="update_is_patient_error" class="text-danger"></div>
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
