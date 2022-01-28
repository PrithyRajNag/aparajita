<div class="tab-pane container" id="time-schedule">
    <h4 class="d-flex justify-content-end mb-4">
        {{--<a href="#" class="btn btn-info f-12" data-toggle="modal" data-target="#addDoctorTimeSchedule"><i class="fas fa-plus-circle"></i>&nbsp; ADD</a>--}}
    </h4>
    <div class="table-responsive f-14">
        <table class="table table-striped text-canter">
            <thead class="bg-transparent">
            <tr>
                {{--<th>Id</th>--}}
                <th>Weekday</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Patient Limit</th>
                {{--<th>Duration</th>--}}
                {{--<th>Option</th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($timeSchedules as $item)
            <tr>
                {{--<td>102</td>--}}
                <td>{{ $item->week_day }}</td>
                <td>{{ normalTimeFormat($item->start_time) }}</td>
                <td>{{ normalTimeFormat($item->end_time) }}</td>
                <td>{{ $item->patient_limit }}</td>
                {{--<td>--}}
                    {{--<a href="#" class="btn btn-danger f-11" data-toggle="modal" data-target="#"><i class="fas fa-trash-alt"></i>&nbsp; Delete</a>--}}
                {{--</td>--}}
            </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

