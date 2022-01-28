<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Add Test</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="createTestForm" class="clearfix" method="" style="width: 100%; display: contents;">
                    <div class="form-group col-sm-12">
                        <label class="form-label font-weight-bold">Search Test</label>
                        <input type="text" id="test_search" name="test_search"
                               class="form-control form-control-sm border-dark" />
                        <ul class="dropdown" id="test_search_result"></ul>
                    </div>

                    <input type="text" id="test_id" name="test_id" hidden>

                    <div class="form-group col-sm-6">
                        <label>Test Name</label>
                        <input type="text" name="title" class="form-control" placeholder="Name" disabled>
                        <div id="title_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control" placeholder="Price" disabled>
                        <div id="price_error" class="text-danger"></div>
                    </div>

                    <!-- <div class="form-group col-sm-6">
                        <label>Room No</label>
                        <input type="text" name="room" class="form-control" placeholder="Room No">
                        <div id="room_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Floor/Level</label>
                        <input type="text" name="floor" class="form-control" placeholder="Floor/Level">
                        <div id="floor_error" class="text-danger"></div>
                    </div> -->

                    <div class="form-group col-sm-6">
                        <label>Delivery Date</label>
                        <input type="date" name="delivery_date" class="form-control take_future_date" placeholder="Delivery Date">
                        <div id="delivery_date_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Delivery Time</label>
                        <input type="time" name="delivery_time" class="form-control" placeholder="Delivery Time">
                        <div id="delivery_time_error" class="text-danger"></div>
                    </div>
                    <div class="form-group mt-5 col-md-4 offset-md-4">
                        <input type="button" name="createTestBtn" id="createTestBtn" value="Add" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
