<div class="tab-pane container" id="holiday">
    <h4 class="d-flex justify-content-end mb-4">
        {{--<a href="#" class="btn btn-info f-12" data-toggle="modal" data-target="#addDoctorHolidayHistory"><i class="fas fa-plus-circle"></i>&nbsp; ADD</a>--}}
    </h4>
    <div class="table-responsive f-14">
        <table class="table table-striped text-canter">
            <thead class="bg-transparent">
            <tr>
                {{--<th>Id</th>--}}
                <th>Date</th>
                <th width="300px">Remark</th>
                {{--<th>Option</th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($holidays as $item)
            <tr>
                {{--<td>102</td>--}}
                <td>{{ normalDateFormat($item->start_date) }}</td>
                <td class="text-justify">
                {{ $item->note != null ? $item->note : '' }}
                {{--<td>--}}
                    {{--<a href="#" class="btn btn-primary f-11 mb-1" data-toggle="modal" data-target="#editDoctorHolidayHistory"><i class="fas fa-edit"></i>&nbsp; Edit</a>--}}
                    {{--<a href="#" class="btn btn-danger f-11 mb-1" data-toggle="model" data-target="#"><i class="fas fa-trash-alt"></i>&nbsp; Delete</a>--}}
                {{--</td>--}}
            </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
