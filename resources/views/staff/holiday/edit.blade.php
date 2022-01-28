<div class="modal fade" id="edit">
    <div class="modal-dialog modal-dialog-centered">
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

                    <div class="form-group col-md-12">
                        <label>Start Date</label>
                        <input type="date" id="start_date" name="start_date" class="form-control take_future_date">
                        <div id="update_start_date_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>End Date</label>
                        <input type="date" id="end_date" name="end_date" class="form-control take_future_date">
                        <div id="update_end_date_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Staff Name</label>
                        <select name="user_id" id="user_id" class="form-control select2">
{{--                            <option  hidden></option>--}}
                            @foreach($users as $item)
                                <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                            @endforeach
                        </select>
                        <div id="update_user_id_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-12">
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
