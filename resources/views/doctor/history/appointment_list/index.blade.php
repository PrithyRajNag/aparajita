<div class="tab-pane container" id="case">
{{--    <h4 class="d-flex justify-content-end mb-4">--}}
{{--        <span class="text-color font-weight-bold">Total Appointment List</span>--}}
{{--    </h4>--}}
    <div class="table-responsive f-14">
        <table class="table table-striped text-canter">
            <thead class="bg-transparent">
            <tr>
                {{--<th>ID</th>--}}
                <th>Patient</th>
                <th>Date & Time</th>
                {{--<th>Remarks</th>--}}
                {{--<th>Option</th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($appointments as $item)
                <tr>
{{--                    <td>{{ $item->patients->user_unique_id }}</td>--}}
                    <td>{{ $item->patients->full_name }}</td>
                    <td>{{ normalDateFormat($item->date) .' => '. normalTimeFormat($item->start_time).'-'.normalTimeFormat($item->end_time)}}</td>
                    {{--<td>Complete</td>--}}
                    {{--<td>--}}
                        {{--<a href="#" class="btn btn-info f-11" data-toggle="modal" data-target="#editAppointmentsHistory"><i class="fas fa-edit"></i>&nbsp;</a>--}}
                        {{--<a href="#" class="btn btn-danger f-11" data-toggle="modal" data-target="#"><i class="fas fa-trash-alt"></i>&nbsp;</a>--}}
                    {{--</td>--}}
                </tr>
            @endforeach
            {{--<tr>--}}
                {{--<td>007</td>--}}
                {{--<td>Mr. Patient</td>--}}
                {{--<td>01-01-2021 => 11:45 AM</td>--}}
                {{--<td>Hard Patient</td>--}}
                {{--<td>--}}
                    {{--<a href="#" class="btn btn-danger f-11" data-toggle="modal" data-target="#"><i class="fas fa-trash-alt"></i>&nbsp;</a>--}}
                {{--</td>--}}
            {{--</tr>--}}
            </tbody>
        </table>
    </div>
</div>
