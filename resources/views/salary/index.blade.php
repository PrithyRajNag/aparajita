@extends('layouts.master')
@section('content')
    <!-- Start Salary Sheet Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            <div id="success-msg" class="alert alert-success"></div>
            <div class="card border-success">
                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Monthly Salary Sheet</span>
                    {{--                    <a href="#" class="btn btn-light" data-toggle="modal" data-target="#add"><i--}}
                    {{--                            class="fas fa-plus-circle"></i>&nbsp; Give Salary</a>--}}
                </h4>
                <div class="card-body f-13">
                    <div class="table-responsive" id="">
                        <table class="table table-striped text-canter table-col-bar">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Employer name</th>
                                <th>Role name</th>
                                <th>Salary Amount</th>
{{--                                @if(checkUserRole('salary.salarySheet'))--}}
{{--                                    <th>Salary Sheet</th>--}}
{{--                                @endif--}}
                                @if(checkUserRole('salary.pay'))
                                    <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contentData as $item)
                                <td>{{ ++$loop->index }}</td>
                                <td>
                                    <a href="#" type="button"
                                       class="text-info">{{ ucwords($item->full_name) }}</a>
                                </td>
                                <td>{{ $item->getRoleNames()[0] }}</td>
                                <td>{{ $item->salary }}</td>
{{--                                @if(checkUserRole('salary.salarySheet'))--}}
{{--                                    <td>--}}
{{--                                        --}}
{{--                                    </td>--}}
{{--                                @endif--}}
                                {{--                                                                <td>{{ $item->bills }}</td>--}}
                                {{--                                                                <td>{{ $item->bills->bill_type ?? 'Missing' }}--}}

                                <td>
                                    <a href="{{route('salary.salarySheet', $item->id)}}"
                                       class="btn btn-info f-11"><i
                                            class="fas fa-info"></i>&nbsp; Info</a>

                                    @if(checkUserRole('salary.pay'))
                                        @if(checkSalaryPayDate($item->bills->bill_type ?? 0, $item->bills->created_at->month ?? 0, $item->bills->created_at->year ?? 0))
                                            {{ 'Paid at ' . normalDateFormat( $item->date ) }}
                                        @else
                                            <form id="delete-form-{{ $loop->index }}"
                                                  action="{{ route('salary.pay',  $item->id) }}"
                                                  method="post"
                                                  class="form-horizontal d-inline">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <div class="btn-group">
                                                    <button onclick="deleteData({{ $loop->index }})" type="button"
                                                            class="btn btn-danger waves-effect waves-light btn-sm align-items-center">
                                                        <i class="fas fa-money-bill"></i>&nbsp; Pay
                                                    </button>
                                                </div>
                                            </form>
                                        @endif
                                    @endif
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
    <!-- End Accounts List Model -->

    <!-- Start Add New Accounts Model -->
    {{--    @include('salary.create')--}}
    <!-- End Add New Accounts Cost Model -->

    <!-- Start Edit Accounts Cost Model -->
    {{--    @include('salary.edit')--}}
    <!-- End Edit Accounts Cost Model -->
@endsection
@push('customScripts')
    <script>

        // Script(For Delete)
        function deleteData(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do You Want To Pay The Salary!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Please, Pay!'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('delete-form-' + id).submit();
                    setTimeout(1000);
                    Swal.fire(
                        'Paid!',
                        'Salary Successfully Paid.',
                        'success'
                    )
                }
            })
        }


    </script>

@endpush

