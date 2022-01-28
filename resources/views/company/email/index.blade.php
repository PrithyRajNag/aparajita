@extends('com_layouts.master')
@section('comContent')

    <!-- Start Email Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="modal-title text-light align-self-center">Sent Messages</span>
                    <div class="align-self-center">
                        <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addMessages"><i class="fas fa-plus-circle"></i>&nbsp; Sent Messages</a>

                        <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addMessagesSetting"><i class="fas fa-tools"></i>&nbsp; Setting</a>
                    </div>
                </h4>
                <div class="card-body f-12">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Subject</th>
                                <th>Email</th>
                                <th>Messages</th>
                                <th>Date</th>
                                <th>Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>22</td>
                                <td>Lorem ipsum dolor</td>
                                <td>admin@admin.com</td>
                                <td width="300px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                                <td>12/20/2020</td>
                                <td>
                                    <a href="#" class="btn btn-info f-10" data-toggle="model" data-target="#infoEmail"><i class="fas fa-plus-circle"></i>&nbsp; Info</a>

                                    <a href="#" class="btn btn-danger f-10" data-toggle="modal" data-target="#"><i class="fas fa-plus-circle"></i>&nbsp; Delete</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Email Model -->

    <!-- Start Sent Email Model -->
    @include('company.email.sent_email')
    <!-- End Sent Email Model -->

    <!-- Start Email Setting Model -->
    @include('company.email.setting')
    <!-- End Email Setting Model -->


@endsection
