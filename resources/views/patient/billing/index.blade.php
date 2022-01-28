@extends('layouts.master')
@section('content')

    <!-- Start Test Pay Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Patient Billing</span>
                </h4>
                <div class="card-body f-14">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter table-col-bar">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Patient Name</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>
                                        <a href="{{route('patient.show', $item->id)}}" type="button"
                                           class="text-info">{{ ucwords($item->full_name) }}</a>
                                    </td>
                                    <td>{{$item->phone_number}}</td>
                                    <td>
                                        <a href="{{route('patient.billing.show', $item->id)}}"
                                           class="btn btn-warning btn-sm mb-1 f-11"><i class="fas fa-plus-circle"></i>&nbsp;
                                            Billing Details</a>
                                        <a href="{{route('patient.billing.pdf', $item->id)}}"
                                           class="btn btn-info btn-sm mb-1 f-11"><i
                                                class="fas fa-file-pdf"></i>&nbsp;PDF</a>
                                        <a href="{{route('patient.billing.resolved', $item->id)}}"
                                           class="btn btn-danger btn-sm mb-1 f-11">Close</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Test Pay List Model -->

@endsection
@push('customScripts')

@endpush
