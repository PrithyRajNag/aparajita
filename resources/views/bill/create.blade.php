@extends('layouts.master')
@section('content')
    {{--    <div class="modal fade" id="addPatient">--}}
    {{--    <div class=" modal-lg modal-dialog-centered">--}}
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h4 class="modal-title text-light">Add New Bill</h4>
        </div>
        <div class="modal-body row">
            <form role="form" action="{{route('bill.store')}}" class="clearfix" method="POST"
                  enctype="multipart/form-data" style="width: 100%; display: contents;">
                @csrf
                    <div class="form-group col-sm-6">
                        <label>Title</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Title" required>
                        <div>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('notes') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Amount</label>
                        <input type="number" name="amount" class="form-control" value="{{ old('amount') }}" placeholder="Amount">
                        <div>
                            @if ($errors->has('amount'))
                                <span class="text-danger">{{ $errors->first('notes') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Details</label>
                        <textarea type="text" name="note" class="form-control"  placeholder="Details" required rows="2">{{ old( 'note' ) }}</textarea>
                        <div>
                            @if ($errors->has('note'))
                                <span class="text-danger">{{ $errors->first('note') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Payment Date</label>
                        <input type="date" name="date" class="form-control" value="{{ old('date') }}" placeholder="Payment Date">
                        <div>
                            @if ($errors->has('date'))
                                <span class="text-danger">{{ $errors->first('date') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Paid By</label>
                        <select name="user_id" class="form-control select2">
                            <option hidden></option>
                            @foreach($users as $item)
                                <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                            @endforeach
                        </select>
                        <div>
                            @if ($errors->has('user_id'))
                                <span class="text-danger">{{ $errors->first('user_id') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="document">Document</label>
                        <input type="file" name="document" class="custom-file">
                        <div>
                            @if ($errors->has('document'))
                                <span class="text-danger">{{ $errors->first('document') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mt-5 col-md-4 offset-md-4">
                        <input type="submit" name="createBtn" id="createBtn" value="Save" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
{{--    </div>--}}
{{--</div>--}}
@endsection
