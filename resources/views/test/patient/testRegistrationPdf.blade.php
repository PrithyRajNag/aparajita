<html>
<head>
    <style>
        .barcode-cell {
            width: 100%;
            /*border: 3px solid black;*/
            /*border-radius: 5px;*/
            padding: 10px;
            text-align: center;
            vertical-align: middle;
        }
        .details{
            margin: 0px;
            padding: 0px;
            /*color: red;*/
            text-align: center;
            font-size: 6pt;
            text-transform: uppercase;

        }
    </style>
</head>
<body>

<htmlpagefooter name='token'>
    <div>
        Page {PAGENO} of {nb}
    </div>
</htmlpagefooter>

@foreach($data as $item)
    <div class="lab-portion">
        <div class="barcode-cell">
            <barcode code='{{$item->patientTests->uuid}}' type='C39' class='barcode}}'/>
        </div>
    </div>
    <div class="details">
            Test : {{$item->tests->name}}&nbsp; &nbsp;Lab: {{$item->tests->testCategory->lab->name }}
    </div>
@endforeach
</body>
</html>
