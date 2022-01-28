<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<div class="invoice-box">
    <p class="sig" style="margin: 0px">Printed By : {{ auth()->user()->full_name }}</p>
    <div class="bill-no">
        @foreach($data as $item)
            <label for="">Patient Billing No :</label>
            <span>{{ $item->patient_billing_no ?? '' }}</span>
    </div>
</div>
<h3 style="text-align: center; background: #eee;margin-top: 0px">Patient Billing</h3>
<table >
    <tr>
        <td style="width: 71%" >Name: {{ $item->patients->full_name }}</td>
        <td align="left">Age: {{ $item->patients->age }} Years</td>
    </tr>
    <tr>
        <td>Gender: {{ ucfirst($item->patients->gender) }}</td>
        <td align="left">Phone No: {{ $item->patients->phone_number }}</td>
    </tr>
</table>
<div style="margin-top: 30px">
    <table style="width: 100%">
            <tr class="heading" style="width: 100%; background: #f5e2d0">
                <td style="width: 80%">Details</td>
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
            <tr class="total">
                    <td>Paying Date :</td>
                    <td>{{ normalDateFormat($item->updated_at) }}</td>
                </tr>
            @endif
    </table>
@endforeach
</body>




