@extends('layouts.master')
@section('content')
    <!-- Start Account Daily Cost Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">

            @if(session('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {{ session('success') }}
                </div>
            @endif

            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Organization Daily Earning</span>

                        <a href="{{route('earning.create')}}" class="btn btn-light"><i class="fas fa-plus-circle"></i>&nbsp;
                            ADD</a>

                </h4>
                <div class="card-body f-14">
                    <div class="table-responsive" id="showDoctorList">
                        <table class="table table-striped text-canter table-col-bar">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Billing No</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Received By</th>
                                <th>Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{$item->patient_billing_no}}</td>
                                    <td>{{$item->amount}}</td>
                                    <td>{{ normalDateFormat($item->date)}}</td>
                                    <td>{{$item->users->full_name}}</td>


                                        <td>
                                                 <a href="{{route('earning.pdf', $item->id)}}"
                                                    class="btn btn-info f-12"><i
                                                    class="fas fa-file-pdf"></i>&nbsp;PDF</a>

                                                <a href="{{route('earning.edit', $item->id)}}"
                                                   class="btn btn-primary f-12"><i class="fas fa-edit"></i>&nbsp;
                                                    Edit</a>

                                                <form id="delete-form-{{ $loop->index }}"
                                                      action="{{ route('earning.destroy', $item->id) }}"
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
                                        </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bill List Model -->


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
                confirmButtonColor: '#3085D6',
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

