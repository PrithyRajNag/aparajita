<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Add</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="createForm"  class="clearfix" method="POST" enctype="multipart/form-data" style="width: 100%; display: contents;">

                    @csrf
                    <div class="form-group col-md-6">
                        <label>Name : </label>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                        <div id="name_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Date : </label>
                        <input type="date" name="date" class="form-control" placeholder="Date">
                        <div id="date_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Blood Group : </label>
                        <select name="blood_group_id" class="form-control">
                            <option  hidden></option>
                            @foreach($bloodGroups as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <div id="blood_group_id_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Bag Number : </label>
                        <select name="blood_collection_id" class="form-control">
                            {{--<option  hidden></option>--}}
                            {{--@foreach($availableBlood as $item)--}}
                                {{--<option value="{{ $item->id }}">{{ $item->bag_number }}</option>--}}
                            {{--@endforeach--}}
                        </select>
                        <div id="blood_collection_id_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Phone : </label>
                        <input type="text" name="phone_number" class="form-control" placeholder="+880" >
                        <div id="phone_number_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Blood For Our Patient  ? </label>
                        <select name="is_patient" class="form-control">
                            <option  hidden></option>
                            <option  value="1">Yes</option>
                            <option  value="0">NO</option>
                        </select>
                        <div id="is_patient_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Address : </label>
                        <textarea type="text" name="address" class="form-control" placeholder="Address"></textarea>
                        <div id="address_error" class="text-danger"></div>
                    </div>

                    <div class="form-group mt-5 col-md-4 offset-md-4">
                        <button type="submit" name="createBtn" id="createBtn" value="Save" class="btn btn-success btn-block btn-lg">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
