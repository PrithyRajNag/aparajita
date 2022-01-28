<div class="modal fade" id="info">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Health Card Information</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" action="" class="clearfix" method="post" enctype="multipart/form-data" style="width: 100%; display: contents;">
                    <div id="img" class="col-sm-5 text-center text-white">
{{--                        <img src="{{ getUserImage($item->image) }}" class="img-fluid mt-2 p-2">--}}
                    </div>
                    <div class="col-sm-7">
                        <div>
                            <h2 class="">Information</h2>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-2">Name</p>
                                    <h6 class="text-muted mb-4" id="show_patient_name"></h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2">Phone</p>
                                    <h6 class="text-muted mb-4" id="show_phone_number"></h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2">Card Number</p>
                                    <h6 class="text-muted mb-4" id="show_card_number"></h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2">Issue Date</p>
                                    <h6 class="text-muted mb-4" id="show_issue_date"></h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2">Expiry Date</p>
                                    <h6 class="text-muted mb-4" id="show_expire_date"></h6>
                                </div>
                                <div class="col-sm-12">
                                    <p class="mb-2">Remarks</p>
                                    <span class="text-justify mb-4" id="show_note"></span>
                                </div>
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
