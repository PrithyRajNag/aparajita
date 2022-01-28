<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<div class="invoice-box">
    <p class="sig" style="margin: 0px">Printed By : {{ auth()->user()->full_name }}</p>
{{--    <hr style="color: black; width: 15%; text-align: right; margin: 0px">--}}
{{--    <p class="sig"><b></b></p>--}}
<div class="bill-no">
    @foreach($data as $item)
        <label for="">Patient Billing No :</label>
        <span>{{ $item->patient_billing_no ?? '' }}</span>
        @endforeach
</div>
    <h3 style="text-align: center; background: #eee">Patient Billing</h3>
<div>
    <table >
        <tr>
            <td style="width: 67%" >Name: {{ $patientInfo->full_name }}</td>
            <td style="align:left" >Age: {{ $patientInfo->age }} Years</td>
        </tr>
        <tr>
            <td style="width: 67%">Gender: {{ ucfirst($patientInfo->gender) }}</td>
            <td style="align:left">Phone No: {{ $patientInfo->phone_number }}</td>
        </tr>
        @if($caseHistories != null)
            <tr>
                <td style="width: 67%">Admit Date: {{ normalDateFormat($caseHistories->admit_date) }}</td>
                <td style="align:left">Admit Time: {{ normalTimeFormat($caseHistories->admit_time) }}</td>
            </tr>
            <tr>
                <td style="width: 67%">Discharge Date: {{ normalDateFormat($dischargeDate->toDateString()) }}</td>
                <td style="align:left">Discharge Time: {{ normalTimeFormat($dischargeDate->toTimeString()) }}</td>
            </tr>
        @endif
        @if($caseHistories == null)
            <tr>
                <td>Date: {{ normalDateFormat($dischargeDate->toDateString()) }}</td>
            </tr>
        @endif
    </table>
</div>

    <div class="test-info" style="padding-bottom: 20px">
        @if($tests != null)
            <div class="test-info">
                <h3>Test Information</h3>
                <div class="doc-info">
                    @foreach($referredDoctor as $item)
                    <label>Referred Doctor Name :</label>
                    <span>{{ ucwords($item->name) }}</span>
                    @endforeach
                </div>
            </div>
            <table>

                <tr class="heading test-header">
                    <td style="width: 33.33%;text-align: center">Test Name</td>
                    <td style="width: 33.33%;text-align: center">Lab Name</td>
                    <td style="width: 33.33%;text-align: center">Price</td>
{{--                    <td style="width: 25%;text-align: center">Input Date</td>--}}
{{--                    <td style="width: 25%;text-align: center">Delivery Date</td>--}}
                </tr>
                @foreach($tests as $item)
                    <tr class="item">
                        <td style="width: 33.33%;text-align: center">{{ $item->tests->name }}</td>
                        <td style="width: 33.33%;text-align: center">{{ $item->tests->testCategory->lab->name }}</td>
                        <td style="width: 33.33%;text-align: center">{{ $item->price }}</td>
{{--                        <td style="width: 25%;text-align: center">{{ normalDateFormat($item->input_date) }}</td>--}}
{{--                        <td style="width: 25%;text-align: center">{{ $item->delivery_date != null ? normalDateFormat($item->delivery_date) : normalDateFormat($dischargeDate->toDateString()) }}</td>--}}

                    </tr>
                @endforeach
            </table>
        @endif
    </div>






<div>
    <table>
        @foreach($data as $item)
            <tr class="heading">
                <td>Details</td>
                <td>Amount</td>
            </tr>
            @if($item->total_bed_price != null)
                <tr class="item">
                    <td>Total Bed Charge:</td>

                    <td>{{ $item->total_bed_price }}</td>
                </tr>
            @endif
            @if($item->total_test_price != null)
                <tr class="item">
                    <td>Total Test Charge:</td>

                    <td>{{ $item->total_test_price }}</td>
                </tr>
            @endif
            @if($item->total_service_price != null)
                <tr class="item">
                    <td>Total Service Charge:</td>

                    <td>{{ $item->total_service_price }}</td>
                </tr>
            @endif
            @if($item->sub_total != null)
                <tr class="item">
                    <td>Sub Total:</td>

                    <td>{{ $item->sub_total }}</td>
                </tr>
            @endif
            @if($item->discount != null)
                <tr class="item">
                    <td>Discount</td>

                    <td>{{ $item->discount }} %</td>
                </tr>
            @endif
            @if($item->gross_total != null)
                <tr class="item">
                    <td>Gross Total</td>

                    <td>{{ $item->gross_total }}</td>
                </tr>
            @endif
            @if($item->total_paid != null)
                <tr class="total">
                    <td>Total Paid:</td>
                    <td>{{ $item->total_paid }}</td>
                </tr>
                <tr class="total">
                    <td>Due:</td>
                    <td>{{ ($item->gross_total)-($item->total_paid) }}</td>
                </tr>
            @endif
        @endforeach
    </table>
</div>
    <br>
    <br>
    <hr style="color: black; width: 20%; text-align: right;margin-bottom: 0px">
    <p class="sig"><b>Receiver Signature</b></p>

</div>
</body>



