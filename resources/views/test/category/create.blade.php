<!-- Start Add New Test Category Model -->
<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Add</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="createForm" action="{{route('test.category.store')}}" method="POST" style="width: 100%; display: contents;">

                    @csrf {{--added--}}
                    <div class="form-group col-md-12">
                        <label>Lab Name</label>
                        <select name="lab_id" class="form-control">
                            <option  hidden></option>
                            @foreach($labs as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <div id="lab_id_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Test Category Name</label>
                        <input type="text" name="name"  class="form-control" placeholder="Name">
                        <div id="name_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Description</label>
                        <textarea name="description" placeholder="Description" class="form-control"  rows="2"></textarea>
                        <div id="description_error" class="text-danger"></div>
                    </div>

                    <div class="form-group mb-20 col-sm-4 offset-4">
                        <button id="createBtn" type="submit" name="add" value="Save" class="btn btn-success btn-block btn-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Add New Test Category Model -->
