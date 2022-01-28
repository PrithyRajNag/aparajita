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
            margin: 0px 0px;
            margin-bottom: 10px;
            padding: 0px;
            /*color: red;*/
            text-align: center;
            font-size: 6pt;
            text-transform: uppercase;

        }
        hr{
            margin: 0px;
        }
    </style>
</head>
<body>

<htmlpagefooter name='token'>
    <div>
        Page {PAGENO} of {nb}
    </div>
</htmlpagefooter>
{{--<div class="lab-portion">--}}
{{--    <div class="barcode-cell">--}}
{{--        <barcode code='{{$data->uuid}}' type='C39' class='barcode}}'/>--}}
{{--    </div>--}}
{{--</div>--}}
<div style="margin-bottom: 10px">
@foreach($data as $test)
    <div class="lab-portion">
        <div class="barcode-cell">
            <barcode code='{{$test->uuid}}' type='C39' class='barcode}}'/>
        </div>
    </div>
@endforeach
@foreach($testItems as $item)

    <div class="details">
        Test : {{$item->tests->name}}&nbsp; &nbsp;Lab: {{$item->tests->testCategory->lab->name }}
    </div>
@endforeach
    <hr>
</div>

@foreach($testItems as $item)
    @foreach($data as $test)
        <div class="lab-portion">
            <div class="barcode-cell">
                <barcode code='{{$test->uuid}}' type='C39' class='barcode}}'/>
            </div>
        </div>
    @endforeach
    <div class="details">
        Test : {{$item->tests->name}}&nbsp; &nbsp;Lab: {{$item->tests->testCategory->lab->name }}
    </div>
    <hr>
@endforeach
</body>
</html>

