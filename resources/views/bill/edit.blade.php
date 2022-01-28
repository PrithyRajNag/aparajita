@extends('layouts.master')
@section('content')
    <div class="modal-header bg-info">
        <h4 class="modal-title text-light">Update Bill</h4>
    </div>
    <div class="modal-body row">
        <form role="form" id="editForm" action="{{route('bill.update', $data->id)}}" method="POST" enctype="multipart/form-data" class="clearfix"  style="width: 100%; display: contents;">
            @csrf
            @method('PUT')

                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="organization_id" id="organization_id">


            <div class="form-group col-sm-6">
                <label>Title</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $data->name) }}" placeholder="Title" required>
                <div>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group col-sm-6">
                <label>Amount</label>
                <input type="number" name="amount" class="form-control" value="{{ old('amount', $data->amount) }}" placeholder="Amount">
                <div>
                    @if ($errors->has('amount'))
                        <span class="text-danger">{{ $errors->first('amount') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group col-sm-6">
                <label>Details</label>
                <textarea type="text" name="note" class="form-control"  placeholder="Details" required rows="2">{{ old('note', $data->note) }}</textarea>
                <div>
                    @if ($errors->has('note'))
                        <span class="text-danger">{{ $errors->first('note') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group col-sm-6">
                <label>Payment Date</label>
                <input type="date" name="date" class="form-control" value="{{ old('date', $data->date) }}" placeholder="Payment Date">
                <div>
                    @if ($errors->has('date'))
                        <span class="text-danger">{{ $errors->first('date') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group col-sm-6">
                <label>Paid By</label>
                <select name="user_id" class="form-control select2">
                    <option hidden value="{{ old('user_id', $data->user_id) }}"> {{ $data->users->full_name }}</option>
                    @foreach($users as $item)
                        <option value="{{ $item->id }}" {{$item->user_id == $item->id  ? 'selected' : ''}}>{{ $item->full_name }}</option>
                    @endforeach
                </select>
                <div>
                    @if ($errors->has('user_id'))
                        <span class="text-danger">{{ $errors->first('notes') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group col-sm-6">
                <label for="document">Document</label>
                <input type="file" name="document" class="custom-file">
                <div>
                    @if ($errors->has('document'))
                        <span class="text-danger">{{ $errors->first('notes') }}</span>
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
<!-- End Edit Accounts Cost Model -->
