@extends('layouts.master')
@section('content')
    {{--    <div class="modal fade" id="addPatient">--}}
    {{--    <div class=" modal-lg modal-dialog-centered">--}}
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h4 class="modal-title text-light">Add New Earning Record</h4>
        </div>
        <div class="modal-body row">
            <form role="form" action="{{route('earning.store')}}" class="clearfix" method="POST"
                  enctype="multipart/form-data" style="width: 100%; display: contents;">
                @csrf
                <div class="form-group col-sm-6">
                    <label>Billing No</label>
                    <input type="text" name="patient_billing_no" class="form-control"
                           value="{{ old('patient_billing_no') }}" placeholder="Billing No" required>
                    <div>
                        @if ($errors->has('patient_billing_no'))
                            <span class="text-danger">{{ $errors->first('patient_billing_no') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group col-sm-6">
                    <label>Amount</label>
                    <input type="number" name="amount" class="form-control" value="{{ old('amount') }}"
                           placeholder="Amount">
                    <div>
                        @if ($errors->has('amount'))
                            <span class="text-danger">{{ $errors->first('notes') }}</span>
                        @endif
                    </div>
                </div>


                <div class="form-group col-12 check-part">

                    <div class="row">

                        <div class="form-group col-sm-6">
                            <label>Bank Name</label>
                            <input type="text" name="bank_name" class="form-control" value="{{ old('bank_name') }}"
                                   placeholder="Bank Name">
                            <div>
                                @if ($errors->has('bank_name'))
                                    <span class="text-danger">{{ $errors->first('bank_name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label>Cheque No</label>
                            <input type="text" name="cheque_no" class="form-control" value="{{ old('cheque_no') }}"
                                   placeholder="Cheque No">
                            <div>
                                @if ($errors->has('cheque_no'))
                                    <span class="text-danger">{{ $errors->first('cheque_no') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <p>*Please fill this portion if the Bill is in Bank Cheque , otherwise skip.</p>
                </div>

                <div class="form-group mt-5 col-md-4 offset-md-4">
                    <input type="submit" name="createBtn" id="createBtn" value="Save"
                           class="btn btn-success btn-block btn-lg">
                </div>
            </form>
        </div>
    </div>
    {{--    </div>--}}
    {{--</div>--}}
@endsection
