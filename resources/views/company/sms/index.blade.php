@extends('com_layouts.master')
@section('comContent')
    <!-- Start Sent SMS Model -->
    <div class="row justify-content-center">
        <div class="col-sm-12 m-3">
            <div class="card-deck mt-3 text-light text-center font-weight-bold">
                @if(session('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card bg-info">
                    <div class="card-body text-left">
                        <h3>0</h3>
                        <p class="font-weight-normal">Today's Message</p>
                    </div>
                </div>

                <div class="card bg-primary">
                    <div class="card-body text-left">
                        <h3>0</h3>
                        <p class="font-weight-normal">Today Send</p>
                    </div>
                </div>

                <div class="card bg-warning">
                    <div class="card-body text-left">
                        <h3 class="text-dark">0</h3>
                        <p class="font-weight-normal text-dark">Available Now</p>
                    </div>
                </div>

                <div class="card bg-danger">
                    <div class="card-body text-left">
                        <h3>15</h3>
                        <p class="font-weight-normal">Total Send</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="modal-title text-light align-self-center">Sent SMS</span>
                    <div class="align-self-center">
                        <a href="{{route('company.sms.create')}}" id="createFormBtn" class="btn btn-light"><i class="fas fa-plus-circle"></i>&nbsp; ADD</a>
{{--                        <a href="#" class="btn btn-light" data-toggle="modal" data-target="#add"><i--}}
{{--                                class="fas fa-plus-circle"></i>&nbsp; Sent SMS</a>--}}

                        {{--                        <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addSmsSetting"><i class="fas fa-tools"></i>&nbsp; Setting</a>--}}
                    </div>
                </h4>
                <div class="card-body f-12">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter table-col-bar">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Organization</th>
                                <th>Sms Amount</th>
                                <th>Date</th>
{{--                                <th>Option</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{$item->organizations->name}}</td>
                                    <td>{{$item->sms_amount}}</td>
                                    <td>{{$item->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Sent SMS Model -->

    <!-- Start New Sent SMS Model -->
{{--    @include('company.sms.sent_sms')--}}
    <!-- End New Sent SMS Model -->

    <!-- Start Send SMS Setting Model -->
{{--    @include('company.sms.setting')--}}
    <!-- End Send SMS Setting Model -->


@endsection

