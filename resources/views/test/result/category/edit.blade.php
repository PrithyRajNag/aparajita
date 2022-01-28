<!-- Start Edit Test Result Category Model -->
<div class="modal fade" id="edit">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light">Edit Now</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div id="error-msg" class="alert alert-danger"></div>
            <div class="modal-body row">

                <div id="error-msg" class="alert alert-danger"></div>

                <form id="editForm" role="form" class="clearfix" style="width: 100%; display: contents;">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="id">

                    <div class="form-group col-md-12">
                        <label>Test Item Name</label>
                        <select name="test_item_id" id="test_item_id" class="form-control">
                            <option  hidden></option>
                            @foreach($testItems as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <div id="update_test_item_id_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Result Category Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                        <div id="update_name_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Description</label>
                        <textarea name="description" id="description" class="form-control" rows="2"></textarea>
                        <div id="update_description_error" class="text-danger"></div>
                    </div>

                    <div class="form-group mb-20 col-sm-4 offset-4">
                        <button type="submit" name="editBtn" id="editBtn" value="Update" class="btn btn-primary btn-block btn-lg">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Edit Test Result Category Model -->
