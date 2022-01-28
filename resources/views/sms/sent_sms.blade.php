<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Sent New Sms</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="createForm" class="clearfix" method="POST"
                      enctype="multipart/form-data" style="width: 100%; display: contents;">
                    @csrf
                    <div class="form-group  col-sm-12">
                        <label class="">Sms To:</label>
                        <div class="">
                            <label for="sms_to">
                                <input type="radio" name="sms_to" value="patient">
                                <span class="mr-sm-2">All Patients</span>
                            </label>
                            <label for="sms_to">
                                <input type="radio" name="sms_to" value="doctor">
                                <span class="mr-sm-2 mt-0">All Doctors</span>
                            </label>
                            <label for="sms_to">
                                <input type="radio" name="sms_to" value="all">
                                <span class="mr-sm-2">All Staff</span>
                            </label>
                            <label for="sms_to">
                                <input type="radio" name="sms_to" value="donor">
                                <span class="mr-sm-2">All Donors</span>
                            </label>
                            <label for="sms_to">
                                <input type="radio" name="sms_to" value="specific">
                                <span class="mr-sm-2">Specific</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-sm-12" id="receiver">
                        <label>Receiver Number</label>
                        <input type="text" name="receiver" class="form-control" placeholder="Receiver Number">
                        <div id="receiver_error" class="text-danger"></div>
                    </div>


                    <div class="form-group col-sm-12">
                        <label>Message</label>
                        <textarea type="text" name="message" class="form-control"
                                  placeholder="Message"></textarea>
                        <div id="message_error" class="text-danger"></div>
                    </div>


                    <div class="form-group mt-3 col-sm-6 offset-sm-3">
                        <input type="submit" name="createBtn" id="createBtn" value="Send"
                               class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
