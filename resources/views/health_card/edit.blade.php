<div class="modal fade" id="edit">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light">Edit Now</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="editForm" action="#" class="clearfix" method="post" style="width: 100%; display: contents;">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="organization_id" id="organization_id">

                    <div class="form-group col-md-12">
                        <label class="d-block">Patient Name</label>
                        <select name="patient_id" id="patient_id" class="form-control" style="width: 100%">
                            <option  hidden></option>
                            @foreach($patients as $item)
                                <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                            @endforeach
                        </select>
                        <div id="update_patient_id_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Card Number</label>
                        <input type="text" name="card_number" id="card_number" class="form-control" placeholder="Card Number" >
                        <div id="update_card_number_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Issue Date</label>
                        <input type="date" name="issue_date" id="issue_date" class="form-control">
                        <div id="update_issue_date_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Expire Date</label>
                        <input type="date" name="expire_date" id="expire_date" class="form-control">
                        <div id="update_expire_date_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Remark</label>
                        <textarea type="text" name="note" id="note" class="form-control" placeholder="Note"></textarea>
                        <div id="update_note_error" class="text-danger"></div>
                    </div>

                    <div class="form-group mb-20 col-sm-4 offset-4">
                        <button type="submit" name="editBtn" id="editBtn" value="Update" class="btn btn-primary btn-block btn-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
