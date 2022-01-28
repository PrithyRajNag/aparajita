<div class="tab-pane container" id="labs">
    <h4 class="d-flex justify-content-end mb-4"></h4>
    <div class="table-responsive f-14">
        <table class="table table-striped text-canter">
            <thead class="bg-transparent">
            <tr>
                <th>SL</th>
                <th>Issue Date</th>
                <th>Delivery Date</th>
{{--                <th>Amount</th>--}}
{{--                <th>Option</th>--}}
            </tr>
            </thead>
            <tbody>
            @if($tests != null)
            @foreach($tests as $item)
            <tr>
                <td>{{ ++$loop->index }}</td>
                <td>{{ normalDateFormat($item->input_date) }}</td>
                <td>{{ normalDateFormat($item->delivery_date) }}</td>
{{--                <td>{{ $item->price }}</td>--}}
{{--                <td>--}}
{{--                    <a href="{{ route('test.patient.report', $item->id) }}" class="btn btn-sm btn-success f-11"><i class="fas fa-eye"></i>&nbsp; Report</a>--}}
{{--                </td>--}}
            </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
