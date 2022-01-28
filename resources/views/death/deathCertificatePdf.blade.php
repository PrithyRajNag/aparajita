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
                {{$item->organization->name}}
            </div>
            <div class="marquee">
                CERTIFICATE OF DEATH
            </div>

            <div class="assignment">
                {{"This is to acknowledge the death of"}}
            </div>

            <div class="person">
                "{{strtoupper($item->patient->full_name)}}"
            </div>
            <div>
                <h4>On <span class="p1">{{\Carbon\Carbon::parse($item->date)->format( 'F')}} {{\Carbon\Carbon::parse($item->date)->format('d')}} </span> in the Year <span class="p1">{{\Carbon\Carbon::parse($item->date)->format('Y')}}</span> at <span class="p1">{{normalTimeFormat($item->time)}}</span> <br> In <span class="p1">{{$item->organization->name}}</span>.</h4>
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
