<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Add New</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="createForm" class="clearfix" enctype="multipart/form-data" method="post" style="width: 100%; display: contents;">
                    @csrf
                    <div class="form-group col-sm-12">
                        <label>Patient</label>
                        <select name="patient_id" class="form-control">
                            <option  hidden></option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->full_name }}</option>
                            @endforeach
                            <div id="patient_id_error" class="text-danger"></div>
                        </select>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Bed Type</label>
                        <select name="bed_type_id" class="form-control">
                            <option  hidden></option>
                            @foreach($bedTypes as $bedType)
                                <option value="{{ $bedType->id }}">{{ $bedType->name }}</option>
                            @endforeach
                        </select>
                        <div id="bed_type_id_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Bed Number</label>
                        <select name="bed_list_id" class="form-control">
                            <option  hidden></option>
                            @foreach($bedList as $item)
                                <option value="{{ $item->id }}">{{ $item->bed_number }}</option>
                            @endforeach
                        </select>
                        <div id="bed_list_id_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Start Date</label>
                        <input type="date" name="start_date" class="form-control" placeholder="Date">
                        <div id="start_date_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>End Date</label>
                        <input type="date" name="end_date" class="form-control" placeholder="Date">
                        <div id="end_date_error" class="text-danger"></div>
                    </div>


                    <div class="form-group mt-5 col-md-4 offset-md-4">
                        <input type="submit" name="createBtn" id="createBtn" value="Save" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
