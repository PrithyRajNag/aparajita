{{--@extends('layouts.master')--}}
{{--@section('content')--}}

<div class="tab-pane container" id="documents">
    <h4 class="d-flex justify-content-end mb-4">
        <a href="{{ route('doctor.history.upload', request()->segment(2)) }}" class="btn btn-info f-12"><i
                class="fas fa-plus-circle"></i>&nbsp; Upload Document</a>
    </h4>
    <div class="col-sm-6 text-center" style="height: 200px; background: #f1f1f1; padding: 30px;">
											<span class="text-center" style="padding-left: 12px;">
												<i class="fas fa-6x fa-file-archive"></i>
											</span>
        @forelse ($documents as $item)
            <p>{{ $item->title }}</p>
            <a href="{{ route('doctor.document.download',  $item->slug) }}">{{ $item->cover }}</a>
        @empty

            <p>No Document found.</p>

        @endforelse
        {{--            <div class="text-center" style="padding-top: 20px;">--}}
        {{--                <a href="#" class="btn btn-info f-11 mb-2" data-toggle="modal" data-target="#editPatient"><i--}}
        {{--                        class="fas fa-download"></i>&nbsp;</a>--}}

        {{--                <a href="#" class="btn btn-danger f-11 mb-2" data-toggle="modal" data-target="#"><i--}}
        {{--                        class="fas fa-trash-alt"></i>&nbsp;</a>--}}
        {{--            </div>--}}
    </div>
    </div>
{{--        <div class="card-body f-14">--}}
{{--            <div class="table-responsive" id="">--}}
{{--                <table class="table table-striped text-canter table-col-bar">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Title</th>--}}
{{--                        <th>Download file</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @forelse ($documents as $item)--}}
{{--                        <tr>--}}
{{--                            <td>{{ $item->title }}</td>--}}
{{--                            <td><a href="{{ route('doctor.history.download', $item->slug) }}">{{ $item->cover }}</a></td>--}}
{{--                        </tr>--}}
{{--                    @empty--}}
{{--                        <tr>--}}
{{--                            <td colspan="2">No books found.</td>--}}
{{--                        </tr>--}}
{{--                    @endforelse--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
