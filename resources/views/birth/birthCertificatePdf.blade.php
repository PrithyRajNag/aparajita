<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    {{--    <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet" type="text/css">--}}
</head>
<body>
@foreach($data as $item)
    <div class="background">
        <div class="container">
            <div>
                <img class="png-img" src = "img/hos-logo.jpg"/>
            </div>
            <div class="logo">
                {{ucwords($item->organization->name)}}
            </div>
            <div class="marquee">
                {{'CERTIFICATE OF BIRTH'}}
            </div>

            <div class="assignment">
                {{"This document acknowledges that"}}
            </div>

            <div class="person">
                "{{strtoupper($item->name)}}"
            </div>
            <div>
                <h4>Sex <span class="p1">{{ucwords($item->gender)}}</span> Weighting <span class="p1">{{$item->weight}}</span> lbs. was born at <span class="p1">{{ucwords($item->address)}}</span> on the
                    <span class="p1"> {{\Carbon\Carbon::parse($item->date)->format('d')}}</span> Day of <span class="p1">{{\Carbon\Carbon::parse($item->date)->format( 'F')}}</span>
                    in the Year of <span class="p1">{{\Carbon\Carbon::parse($item->date)->format('Y')}}</span><br> at <span class="p1">{{normalTimeFormat($item->time)}}</span>
                    <br> In <span class="p1"> {{ucwords($item->organization->name)}}</span>
                    and that parent name are as follows: <br>
                    Father's Name:<span class="p1"> {{strtoupper($item->father_name)}}</span><br>
                    Mother's Name:<span class="p1"> {{strtoupper($item->mother_name)}}</span>
                    </h4>
            </div>

            <br>
            <div class="bottom">
                <hr style="size: 2;color: black; width: 25%; text-align: center">
                <p class="sig"><b>Authorized By:</b> {{$item->doctors->full_name}}</p>
            </div>
        </div>
    </div>


@endforeach




</body>
</html>
