@extends('com_layouts.master')
@section('comContent')

    <!-- Start Admin Setting Model Area -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center font-weight-normal">Settings</span>
                </h4>
                <div class="card-body font-weight-normal row">
                    <form role="form" action="" class="clearfix" method="post" enctype="multipart/form-data" style="width: 100%; display: contents;">
                        <div class="form-group col-md-6">
                            <label>System Name</label>
                            <input type="text" name="system" class="form-control" placeholder="System Name" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Title" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="+880">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Organization Email</label>
                            <input type="text" name="phone" class="form-control" placeholder="Email">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Address</label>
                            <textarea type="text" name="phone" class="form-control" placeholder="Address Area....." rows="2"></textarea>
                        </div>


                        <div class="form-group col-md-6 mt-5">
                            <label>Pationt Images</label>
                            <input type="file" class="default" name="pationt_image">
                        </div>

                        <div class="form-group mb-20 mt-3 col-md-4 offset-md-4">
                            <input type="submit" name="setting" id="" value="Update Setting" class="btn btn-success btn-block btn-lg">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Admin Setting Model Area -->

@endsection
