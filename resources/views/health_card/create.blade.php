<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Add</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="createForm" action="" class="clearfix" method="post" enctype="multipart/form-data" style="width: 100%; display: contents;">
                    @csrf
                    <div class="form-group col-md-12">
                        <label class="d-block">Patient Name</label>
                        <select name="patient_id" class="form-control">
                            <option  hidden></option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->full_name }}</option>
                            @endforeach
                            <div id="patient_id_error" class="text-danger"></div>
                        </select>
                        <div id="patient_id_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Card Number</label>
                        <input type="text" name="card_number" class="form-control" placeholder="Card Number" >
                        <div id="card_number_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Issue Date</label>
                        <input type="date" name="issue_date" class="form-control">
                        <div id="issue_date_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Expire Date</label>
                        <input type="date" name="expire_date" class="form-control">
                        <div id="expire_date_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Remark</label>
                        <textarea type="text" name="note" class="form-control" placeholder="Note"></textarea>
                        <div id="note_error" class="text-danger"></div>
                    </div>

                    <div class="form-group mb-20 col-sm-4 offset-4">
                        <input type="submit" name="createBtn" id="createBtn" value="Save" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
