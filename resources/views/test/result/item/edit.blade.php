<!-- Start Edit Test Result Item Model -->
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
                        <label>Result Category Name</label>
                        <select name="test_result_category_id" id="test_result_category_id" class="form-control">
                            <option  hidden></option>
                            @foreach($testResultCategory as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <div id="update_test_result_category_id_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Result Item Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                        <div id="update_name_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Unit</label>
                        <input type="text" name="unit" id="unit" class="form-control" required>
                        <div id="update_unit_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Normal Range</label>
                        <input type="text" name="normal_range" id="normal_range" class="form-control" required>
                        <div id="update_normal_range_error" class="text-danger"></div>
                    </div>

                    <div class="form-group mb-20 col-sm-4 offset-4">
                        <button type="submit" name="editBtn" id="editBtn" value="Update" class="btn btn-primary btn-block btn-lg">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Edit Test Result Item Model -->
