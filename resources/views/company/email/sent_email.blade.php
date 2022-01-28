<div class="modal fade" id="addMessages">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Sent Messages</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" action="" class="clearfix" method="post" enctype="multipart/form-data" style="width: 100%; display: contents;">
                    <div class="radio form-group col-sm-12">
                        <label><input type="radio" name="radio" id="optionsRadios1" value="allpatient">&nbsp;All Patients</label>
                    </div>

                    <div class="radio form-group col-sm-12">
                        <label><input type="radio" name="radio" id="optionsRadios2" value="allpatient">&nbsp;All Doctor</label>
                    </div>

                    <div class="radio form-group col-sm-12">
                        <label>
                            <input type="radio" name="radio" id="optionsRadios3" value="allblood">&nbsp;Select Blood Group
                            <select class="form-control form-control-sm m-bot15" name="bloodgroup" value="allblood">
                                <option value="A+"> A+ </option>
                                <option value="A-"> A- </option>
                                <option value="B+"> B+ </option>
                                <option value="B-"> B- </option>
                                <option value="AB+"> AB+ </option>
                                <option value="AB-"> AB- </option>
                                <option value="O+"> O+ </option>
                                <option value="O-"> O- </option>
                            </select>
                        </label>
                    </div>

                    <div class="radio form-group col-sm-12">
                        <label>
                            <input type="radio" name="radio" id="optionsRadios4" value="single_patient">
                            <span>New E-mail</span><br>
                            <input type="email" name="email" id="optionsRadios4" placeholder="admin@admin.com">
                        </label>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                    </div>

                    <div class="form-group col-sm-12">
                        <label>Description</label>
                        <textarea type="text" name="description" class="form-control" placeholder="Description" required rows="5"></textarea>
                    </div>

                    <div class="form-group mt-3 col-sm-6 offset-sm-3">
                        <input type="submit" name="addMessagesBtn" id="" value="Sent Messages" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
