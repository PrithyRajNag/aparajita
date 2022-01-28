<div class="tab-pane container" id="bed">
    <h4 class="d-flex justify-content-end mb-4"></h4>
    <div class="table-responsive f-14">
        <table class="table table-striped text-canter">
            <thead class="bg-transparent">
            <tr>
                <th>Bed Id</th>
                <th>Allotted Time</th>
                <th>Discharge Time</th>
            </tr>
            </thead>
            <tbody>
            @foreach($beds as $item)
                <tr>
                    <td>{{ $item->bedList->bed_number }}</td>
                    <td>{{ normalDateFormat($item->start_date) }}</td>
                    <td>{{ $item->end_date != null ? normalDateFormat($item->end_date) : "Not discharged" }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
