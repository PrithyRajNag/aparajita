@extends('layouts.master')
@section('content')

    <!-- Start Accounts Module -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-deck mt-3 text-light text-center font-weight-bold">

                <div class="card bg-primary">
                    <div class="card-header">Today Earning</div>
                    <div class="card-body">
                        <h4>1000.00/=</h4>
                    </div>
                </div>

                <div class="card bg-success">
                    <div class="card-header">Today Cost</div>
                    <div class="card-body">
                        <h4>100.00/=</h4>
                    </div>
                </div>

                <div class="card bg-danger">
                    <div class="card-header">Total Due</div>
                    <div class="card-body">
                        <h4>Work</h4>
                    </div>
                </div>

                <div class="card bg-info">
                    <div class="card-header">Total Balance</div>
                    <div class="card-body">
                        <h4>Work</h4>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Accounts Module -->

    <!-- Start Accounts List Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Daily Accounts List</span>
                    <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addAccounts"><i class="fas fa-plus-circle"></i>&nbsp; ADD Cost</a>
                </h4>
                <div class="card-body f-13">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter table-col-bar">
                            <thead>
                            <tr>
                                <th>Bill Id</th>
                                <th>Bill Type/Name</th>
                                <th>Total Pay</th>
                                <th>Date</th>
                                <th width="350px;">Details</th>
                                <th width="160px;">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>01</td>
                                <td>Dinner Bill</td>
                                <td>570</td>
                                <td>03-12-2020</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                                <td>
                                    <a href="#" class="btn btn-primary f-10" data-toggle="modal" data-target="#editAccounts"><i class="fas fa-plus-circle"></i>&nbsp; Edit</a>

                                    <a href="#" class="btn btn-danger f-10" data-toggle="modal" data-target="#"><i class="fas fa-trash-alt"></i>&nbsp; Delete</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Accounts List Model -->

    <!-- Start Add New Accounts Model -->
    @include('account.create')
    <!-- End Add New Accounts Cost Model -->

    <!-- Start Edit Accounts Cost Model -->
    @include('account.edit')
    <!-- End Edit Accounts Cost Model -->

@endsection
