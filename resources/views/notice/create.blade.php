<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Add Now</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="createForm" class="clearfix" method="POST" style="width: 100%; display: contents;">
                    @csrf
                    <div class="form-group col-sm-6">
                        <label>Select Role</label>
                        <select name="role_id" class="form-control">
                            <option  hidden></option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ ucwords( $role->name ) }}</option>
                            @endforeach
                        </select>
                        <div id="role_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Title" required>
                        <div id="title_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Description</label>
                        <textarea type="text" name="description" class="form-control" placeholder="Description" required rows="2"></textarea>
                        <div id="description_error" class="text-danger"></div>
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

                    <div class="form-group col-sm-6">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            @include('layouts.partials.statusDropdown')
                        </select>
                        <div id="status_error" class="text-danger"></div>
                    </div>
                    <div class="form-group mt-5 col-md-4 offset-md-4">
                        <input type="submit" name="createBtn" id="createBtn" value="Save" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
