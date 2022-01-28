<div class="tab-pane container" id="case">
    <h4 class="d-flex justify-content-end mb-4">
        {{--<a href="#" class="btn btn-info f-12" data-toggle="modal" data-target="#addCaseHistory"><i class="fas fa-plus-circle"></i>&nbsp; Add</a>--}}
    </h4>
    <div class="table-responsive f-14">
        <table class="table table-striped text-canter">
            <thead class="bg-transparent">
            <tr>
                <th>Admit Date</th>
                <th>Discharge Date</th>
{{--                <th>Attendee Name</th>--}}
{{--                <th>Relation</th>--}}
                <th>Description</th>
{{--                <th>Option</th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($caseHistories as $item)
                <tr>
                    <td>{{ normalDateFormat($item->admit_date) .' - '. normalTimeFormat($item->admit_time)}}</td>
                    <td>{{ $item->discharge_date != null ?  normalDateFormat($item->discharge_date) .' - '. normalTimeFormat($item->discharge_time) : "Not Discharged"}}</td>
{{--                    <td>{{ $item->attendee_name }}</td>--}}
{{--                    <td>{{ $item->attendee_relation_with_patient }}</td>--}}
                    <td>{{ $item->notes != null ? $item->notes : '' }}</td>
{{--                    <td>--}}
{{--                        <a href="#" class="btn btn-info f-11" data-toggle="modal" data-target="#editCaseHistory"><i class="fas fa-edit"></i>&nbsp;</a>--}}

{{--                        <a href="#" class="btn btn-danger f-11" data-toggle="modal" data-target="#"><i class="fas fa-trash-alt"></i>&nbsp;</a>--}}
{{--                    </td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
