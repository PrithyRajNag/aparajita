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
                    <input type="hidden" name="role_id" id="role_id">


                    <div class="form-group col-sm-6">
                        <label>Select Role</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option  hidden></option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ ucwords( $role->name ) }}</option>
                            @endforeach
                        </select>
                        <div id="update_role_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Title" required>
                        <div id="update_title_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Description</label>
                        <textarea type="text" name="description" id="description" class="form-control" placeholder="Description" required rows="2"></textarea>
                        <div id="update_description_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Data">
                        <div id="update_start_date_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" placeholder="Data">
                        <div id="update_end_date_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            @include('layouts.partials.statusDropdown')
                        </select>
                    </div>
                    <div class="form-group mt-5 col-md-4 offset-md-4">
                        <button type="submit" name="editBtn" id="editBtn" value="Update" class="btn btn-primary btn-block btn-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
