<div class="tab-pane active container" id="appointments">
{{--    <h4 class="d-flex justify-content-end mb-4">--}}
{{--        <span class="text-color font-weight-bold">Appointments Calender</span>--}}
{{--    </h4>--}}
    <div class="table-responsive f-14">
        <table class="table table-striped text-canter">
            <thead class="bg-transparent">
            <tr>
                <th>Date</th>
                <th>Time Slot</th>
                <th>Patient</th>
                {{--<th>Doctor</th>--}}
                {{--<th>Status</th>--}}
                {{--<th>Option</th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($appointment_calender as $item)
                <tr>
                    <td>{{ normalDateFormat($item->date) }}</td>
                    <td>{{ normalTimeFormat($item->start_time).'-'.normalTimeFormat($item->end_time) }}</td>
                    <td>{{ $item->patients->full_name }}</td>
                    {{--<td>Complete</td>--}}
                    {{--<td>--}}
                        {{--<a href="#" class="btn btn-info f-11" data-toggle="modal" data-target="#editAppointmentsHistory"><i class="fas fa-edit"></i>&nbsp;</a>--}}
                        {{--<a href="#" class="btn btn-danger f-11" data-toggle="modal" data-target="#"><i class="fas fa-trash-alt"></i>&nbsp;</a>--}}
                    {{--</td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
