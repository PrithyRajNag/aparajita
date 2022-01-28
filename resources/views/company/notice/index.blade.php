@extends('com_layouts.master')
@section('comContent')
    <!-- Start Noties Board Model -->
    <div class="row justify-content-center">
        <div class="col-sm-12 m-3">
            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="modal-title text-light align-self-center">Noties Board</span>
                    <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addNot"><i class="fas fa-plus-circle"></i>&nbsp; ADD Not</a>
                </h4>
                <div class="card-body f-12">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Roll</th>
                                <th>Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>22</td>
                                <td>Lorem ipsum dolor</td>
                                <td width="300px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                                <td>12/20/2020</td>
                                <td>12/20/2020</td>
                                <td>All Staff</td>
                                <td>
                                    <a href="#" class="btn btn-primary f-10" data-toggle="modal" data-target="#editNot"><i class="fas fa-plus-circle"></i>&nbsp; Edit</a>

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
    <!-- End Noties Board List Model -->

    <!-- Start Add New Not Model -->
    @include('company.notice.create')
    <!-- End Add New Not Model -->

    <!-- Start Edit Not Model -->
    @include('company.notice.edit')
    <!-- End Edit Not Model -->

@endsection
