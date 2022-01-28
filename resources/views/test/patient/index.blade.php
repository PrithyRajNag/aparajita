@extends('layouts.master')
@section('content')
    <!-- Start OUR Patient Test List Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
{{--            <div id="success-msg" class="alert alert-success"></div>--}}
            @if(session('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {{ session('success') }}
                </div>
            @endif


            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Patient Test List</span>
{{--                    @if(checkUserRole('patient.store'))--}}
                        <a href="{{route('test.patient.create')}}" class="btn btn-light"><i class="fas fa-plus-circle"></i>&nbsp;
                            ADD</a>
{{--                    @endif--}}
                </h4>
                <div class="card-body f-14">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
{{--                                <th>Patient ID</th>--}}
                                <th>Gender</th>
                                <th>Phone</th>
{{--                                @if(checkUserRole('action.patient.index'))--}}
                                    <th>Action</th>
{{--                                @endif--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
{{--                                    @dd($item)--}}
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ $item->patients->full_name }}</td>
{{--                                    <td>{{ $item->slug }}</td>--}}
                                    <td>{{ ucfirst($item->patients->gender) }}</td>
                                    <td>{{ $item->patients->phone_number }}</td>
{{--                                    @if(checkUserRole('action.patient.index'))--}}
                                        <td>
{{--                                            <a href="{{route('patient.history.index', $item->id)}}" class="btn btn-warning mb-1 f-11"><i class="fas fa-plus-circle"></i>&nbsp; History</a>--}}
{{--                                            @if(checkUserRole('patient.show'))--}}
                                            <a href="{{route('test.patient.pdf', $item->id)}}"
                                               class="btn btn-warning f-12"><i
                                                    class="fas fa-file-pdf"></i>&nbsp;PDF</a>
                                                <a href="{{route('test.patient.show', $item->id)}}"
                                                   class="btn btn-info f-11"><i class="fas fa-info"></i>&nbsp; Info</a>
{{--                                            @endif--}}
{{--                                            @if(checkUserRole('patient.update'))--}}
                                                <a href="{{route('test.patient.edit', $item->id)}}"
                                                   class="btn btn-primary f-12"><i class="fas fa-edit"></i>&nbsp;
                                                    Edit</a>
{{--                                            @endif--}}


                                            {{--                                <a href="#" class="btn btn-success mb-1 f-11"><i class="fas fa-plus-circle"></i>&nbsp; Payment</a>--}}
{{--                                            @if(checkUserRole('patient.destroy'))--}}
                                                <form id="delete-form-{{ $loop->index }}"
                                                      action="{{ route('test.patient.destroy', $item->id) }}"
                                                      method="post"
                                                      class="form-horizontal d-inline">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <div class="btn-group">
                                                        <button onclick="deleteData({{ $loop->index }})" type="button"
                                                                class="btn btn-danger waves-effect waves-light btn-sm align-items-center">
                                                            <i class="fas fa-trash"></i>&nbsp; Delete
                                                        </button>
                                                    </div>
                                                </form>
{{--                                            @endif--}}
                                        </td>
{{--                                    @endif--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Our Patient Test List Model -->

    <!-- Start Add New Patient Model -->
    {{--@include('patient.create')--}}
    <!-- End Add New Patient Model -->

    <!-- Start Edit Patient Model -->
    {{--@include('patient.edit')--}}
    <!-- End Edit Doctor Model -->

    <!-- Start Patient Info Model -->
    {{--@include('patient.info')--}}
    <!-- End Patient Info Model -->
@endsection


@push('customScripts')
    <script>

        // Script(For Delete)
        function deleteData(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result)=>{
                if(result.value){
                document.getElementById('delete-form-' + id).submit();
                setTimeout(1000);
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
        }


    </script>
@endpush
