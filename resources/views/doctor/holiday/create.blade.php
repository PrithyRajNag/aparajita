<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Add</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="createForm" class="clearfix" method="POST" enctype="multipart/form-data"
                      style="width: 100%; display: contents;">

                    @csrf

                    <div class="form-group col-md-12">
                        <label>Start Date</label>
                        <input type="date" name="start_date" class="form-control">
                        <div id="start_date_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>End Date</label>
                        <input type="date" name="end_date" class="form-control">
                        <div id="end_date_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Doctor Name</label>
                        <select name="doctor_id" class="form-control">
                            <option hidden></option>
                            @foreach($doctors as $item)
                                <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                            @endforeach
                        </select>
                        <div id="doctor_id_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Note</label>
                        <textarea type="text" name="note" class="form-control" placeholder="Note"></textarea>
                        <div id="note_error" class="text-danger"></div>
                    </div>

                    <div class="form-group mt-5 col-md-4 offset-md-4">
                        <input type="submit" name="createBtn" id="createBtn" value="Save"
                               class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
