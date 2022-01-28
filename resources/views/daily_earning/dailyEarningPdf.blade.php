<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<div class="box">
    <div class="top">
        <h2 style="text-align: center">Daily Earning</h2>
    </div>

    <table style="width: 100%; margin-top: 15px">
        <tr class="heading">
            <td>Billing No</td>
            <td>Amount</td>
            <td>Date</td>
            <td>Bank Name</td>
            <td>Cheque No</td>
        </tr>
        <tr>
            <td>{{ $data->patient_billing_no }}</td>
            <td>{{ $data->amount }}</td>
            <td>{{ $data->date }}</td>
            <td>{{ $data->bank_name ?? 'N/A' }}</td>
            <td>{{ $data->cheque_no ?? 'N/A' }}</td>
        </tr>
    </table>
    <div class="bottom" style=" width: 100%; text-align: right">
        <div class="received" style="width: 25%; text-align: center; margin-left: 75%">
            <p>{{ $data->users->full_name }}</p>
            <hr style="color: black; width: 100%; margin: 2px 0px">
            <p class="signature">Received By</p>
        </div>


    </div>
</div>


</body>
