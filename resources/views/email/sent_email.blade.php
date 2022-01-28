<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Send Email</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="createForm" class="clearfix" method="POST"
                      enctype="multipart/form-data" style="width: 100%; display: contents;">
                    {{--                    {{csrf_field()}}--}}
                    @csrf

                    {{--                    <div class="radio form-group col-sm-12">--}}
                    {{--                        <label>--}}
                    {{--                            <input type="radio" name="radio" id="optionsRadios4" value="single_patient">--}}
                    {{--                            <span>New E-mail</span><br>--}}
                    {{--                            <input type="email" name="email" id="optionsRadios4" placeholder="admin@admin.com">--}}
                    {{--                        </label>--}}
                    {{--                    </div>--}}
                    <div class="form-group  col-sm-12">
                        <label class="">Mail To:</label>
                        <div class="">
                                <label for="email_to">
                                    <input type="radio" name="email_to" value="doctor">
                                    <span class="mr-sm-2 mt-0">All Doctors</span>
                                </label>
                                <label for="email_to">
                                    <input type="radio" name="email_to" value="nurse">
                                    <span class="mr-sm-2">All Nurses</span>
                                </label>
                                <label for="email_to">
                                    <input type="radio" name="email_to" value="specific">
                                    <span class="mr-sm-2">Specific Email</span>
                                </label>
                        </div>
                    </div>

                    <div class="form-group col-sm-12" id="email_id">
                        <label>Receiver Email Id</label>
                        <input type="email" name="email_id" class="form-control" placeholder="Email Id">
                        <div id="email_id_error" class="text-danger"></div>
                    </div>


                    <div class="form-group col-sm-12">
                        <label>Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Subject">
                        <div id="subject_error" class="text-danger"></div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Description</label>
                        <textarea type="text" name="description" class="form-control"
                                  placeholder="Description"></textarea>
                        <div id="description_error" class="text-danger"></div>
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
