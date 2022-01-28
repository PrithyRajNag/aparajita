@extends('layouts.master')
@section('content')

    <div class="info-content">
        <div class="modal-header bg-info">
            <h4 class="modal-title text-light">Patient Billing Details</h4>
        </div>
        @foreach($data as $item)
        <div>
            <h5>Patient Billing No : {{ $item->patient_billing_no }}</h5>
        </div>
        <div class="personal_info mt-3">
            <h5>Personal Information</h5>

            <input type="text" name="patient_id" value="{{ $item->patient_id }}" hidden>
            <div style="border: 1px solid black; padding: 5px">
                <div class="row">
                    <div class="col-md-4">
                        <label class="font-weight-bold">Name :</label>
                        <label>{{ $item->patients->full_name }}</label>
                    </div>
                    <div class="col-md-4">
                        <label class="font-weight-bold">Age :</label>
                        <label>{{ $item->patients->age }}</label>
                    </div>
                    <div class="col-md-4">
                        <label class="font-weight-bold">Gender :</label>
                        <label>{{ $item->patients->gender }}</label>
                    </div>
                    <div class="col-md-4">
                        <label class="font-weight-bold">Phone Number :</label>
                        <label>{{ $item->patients->phone_number }}</label>
                    </div>
                </div>
            </div>
                <div class="row" style="background: #86cfda; margin: 10px 3px" >
                    <div class="col-8 font-weight-bold">Billings</div>
                    <div class="col-4 font-weight-bold">Amount</div>
                </div>
            @if($item->total_bed_price != 0)
                <div class="row" style=" margin: 10px 3px" >
                    <div class="col-8">Bed Charge</div>
                    <div class="col-4">{{ $item->total_bed_price }}</div>
                </div>
             @endif
            @if($item->total_test_price != 0)
                <div class="row" style=" margin: 10px 3px" >
                    <div class="col-8">Test Cost</div>
                    <div class="col-4">{{ $item->total_test_price }}</div>
                </div>
             @endif
            @if($item->total_service_price != 0)
                <div class="row" style=" margin: 10px 3px" >
                    <div class="col-8">Service Charge</div>
                    <div class="col-4">{{ $item->total_service_price }}</div>
                </div>
             @endif
            @if($item->sub_total != 0)
                <div class="row" style=" margin: 10px 3px" >
                    <div class="col-8">Sub Total</div>
                    <div class="col-4">{{ $item->sub_total }}</div>
                </div>
             @endif
            @if($item->discount != 0)
                <div class="row" style=" margin: 10px 3px" >
                    <div class="col-8">Discount</div>
                    <div class="col-4">{{ $item->discount }} %</div>
                </div>
             @endif
            @if($item->gross_total != 0)
                <div class="row" style=" margin: 10px 3px" >
                    <div class="col-8">Gross Total</div>
                    <div class="col-4">{{ $item->gross_total }}</div>
                </div>
             @endif
            @if($item->total_paid != 0)
                <div class="row" style=" margin: 10px 3px" >
                    <div class="col-8">Total Paid</div>
                    <div class="col-4">{{ $item->total_paid }}</div>
                </div>
             @endif

{{--            @if($advance != 0)--}}
{{--                <h6>Paying Dates</h6>--}}
{{--            @foreach($advance as $paid)--}}
{{--                    <div class="row" style=" margin: 10px 3px" >--}}
{{--                        <div class="col-8">Date</div>--}}
{{--                        <div class="col-4">{{ normalDateFormat($paid->date) }}</div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            @endif--}}
            <div class="row" style=" margin: 10px 3px" >
                <div class="col-8">Paying Date</div>
                <div class="col-4">{{ normalDateFormat($item->updated_at) }}</div>
            </div>

                <div class="row" style=" margin-top: 20px" >
                    <a href="{{route('patient.billingList.old')}}"
                       class="btn btn-success m-auto">Back</a>
                </div>
        </div>
        @endforeach
    </div>


@endsection
@push('customScripts')

@endpush


