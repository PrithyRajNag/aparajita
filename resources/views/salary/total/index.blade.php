@extends('layouts.master')
@section('content')

    <!-- Start Salary Sheet Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Employer Total Salary Sheet</span>
                </h4>
                <div class="card-body f-13">
                    <form role="form" action="" class="clearfix" method="post" enctype="multipart/form-data"
                          style="width: 100%; display: contents;">


                        {{--                        <div class="col-sm-5 text-center text-white">--}}
                        {{--                            <img src="{{ asset('/img/male_avatar.png')}}" class="img-fluid mt-2 p-2">--}}
                        {{--                        </div>--}}
                        {{--                        <div class="col-sm-7">--}}
                        <div>
                            <h2>Information</h2>

                            <input type="hidden" name="organization_id" id="organization_id">

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label font-weight-bold pt-0">Name : </label>
                                {{ucwords($data->full_name)}}
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label font-weight-bold pt-0">NID : </label>
                                {{$data->nid}}
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label font-weight-bold pt-0">Date Of Birth : </label>
                                {{ Carbon\Carbon::parse($data->dob)->format('d F Y') }}
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label font-weight-bold pt-0">Blood Group : </label>
                                {{ucwords($data->bloodGroups->name)}}
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label font-weight-bold pt-0">Email Address : </label>
                                {{$data->email}}
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label font-weight-bold pt-0">Mobile No : </label>
                                {{$data->phone_number}}
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label font-weight-bold pt-0">Gender : </label>
                                {{ucfirst($data->gender)}}
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label font-weight-bold pt-0">Address : </label>
                                {{ucwords($data->address)}}
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label font-weight-bold pt-0">Joining date : </label>
                                {{ Carbon\Carbon::parse($data->join_date)->format('d F Y') }}
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label font-weight-bold pt-0">Monthly Salary : </label>
                                {{ucwords($data->salary)}}
                            </div>
                        </div>
                        {{--                        </div>--}}
                        {{--                        <div class="m-auto">--}}
                        {{--                            <a class="btn btn-success px-4 py-2" href="{{route('staff.index')}}">Back</a>--}}
                        {{--                            <a class="btn btn-primary px-4 py-2" href="{{route('staff.edit',$data->id)}}">Update</a>--}}
                        {{--                        </div>--}}

                    </form>
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter table-col-bar">
                            <thead>
                            <tr>
                                <th>SL</th>
                                {{--                                <th>Employer name</th>--}}
                                {{--                                <th>Role</th>--}}
                                <th>Pay Date</th>
                                <th>Salary</th>
                                {{--                                <th>Total Paid</th>--}}
                                {{--                                <th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    {{--                                <td>--}}
                                    {{--                                    <a href="#" type="button"--}}
                                    {{--                                       class="text-info">{{ ucwords($item->full_name) }}</a>--}}
                                    {{--                                </td>--}}
                                    {{--                                <td>{{ $item->getRoleNames()[0] }}</td>--}}
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->amount }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Accounts List Model -->

    <!-- Start Add New Accounts Model -->
    {{--    @include('salary.total.create')--}}
    <!-- End Add New Accounts Cost Model -->

    <!-- Start Edit Accounts Cost Model -->
    {{--    @include('salary.total.edit')--}}
    <!-- End Edit Accounts Cost Model -->

@endsection
