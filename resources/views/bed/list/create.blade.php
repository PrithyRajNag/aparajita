<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Add New</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="createForm" class="clearfix" method="post" enctype="multipart/form-data" style="width: 100%; display: contents;">
                    @csrf
                    <div class="form-group col-sm-12">
                        <label>Bed Number</label>
                        <input type="text" name="bed_number" class="form-control" placeholder="Bed Number" required>
                        <div id="bed_number_error" class="text-danger"></div>
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
                        <label>Floor</label>
                        <input type="text" name="floor" class="form-control" placeholder="Floor" required>
                        <div id="floor_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Description</label>
                        <input type="text" name="description" class="form-control" placeholder="Description">
                        <div id="description_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Charge</label>
                        <input type="text" name="price" class="form-control" placeholder="Charge">
                        <div id="price_error" class="text-danger"></div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Availability</label>
                        <select name="is_available" class="form-control">
                            @include('layouts.partials.is_availableDropdown')
                        </select>
                        <div id="is_available_error" class="text-danger"></div>
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
