<div class="modal fade" id="info">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light">Death Person Information</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div id="error-msg" class="alert alert-danger"></div>
            <div class="modal-body row">
                <form role="form" action="#" class="clearfix" method="post" style="width: 100%; display: contents;">

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Name :</label>
                        <p class="d-inline" id="show_name"></p>

                    </div>

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Date : </label>
                        <p class="d-inline" id="show_date"></p>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Time :</label>
                        <p class="d-inline" id="show_time"></p>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Phone :</label>
                        <p class="d-inline" id="show_phone_number"></p>
                    </div>


                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Note :</label>
                        <p class="d-inline" id="show_note"></p>
                    </div>

{{--                    <div class="m-auto">--}}
{{--                        @if(checkUserRole('birth.index'))--}}
{{--                            <a class="btn btn-success px-4 py-2" href="{{route('birth.index')}}">Back</a>--}}
{{--                        @endif--}}
{{--                        @if(checkUserRole('birth.update'))--}}
{{--                            <a class="btn btn-primary px-4 py-2" href="{{route('birth.update',$item->id)}}">Update</a>--}}
{{--                        @endif--}}
{{--                    </div>--}}
                </form>
            </div>
        </div>
    </div>
</div>
