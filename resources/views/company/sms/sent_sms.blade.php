@extends('com_layouts.master')
@section('comContent')
{{--<div class="modal fade" id="add">--}}
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Send SMS</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body row">
                <form role="form" class="clearfix" id="createForm" action="{{route('company.sms.store')}}"
                      method="POST"
                      enctype="multipart/form-data" style="width:100%">
                    @csrf
                    <div class="form-group col-md-12">
                        <label>Organizations Name</label>
                        <select name="organization_id" id="organization_id" class="form-control" style="width: 100%;height: auto">
                            <option hidden></option>
                            @foreach($organizations as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('organization_id'))
                            <span class="text-danger">{{ $errors->first('organization_id') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-12">
                        <label>Sms Amount</label>
                        <input type="number" name="sms_amount" id="sms_amount" class="form-control" placeholder="Amount">
                        @if ($errors->has('sms_amount'))
                            <span class="text-danger">{{ $errors->first('sms_amount') }}</span>
                        @endif
                    </div>

                    <div class="form-group mt-3 col-sm-6 offset-sm-3">
                        <input type="submit" name="addSmsBtn" id="" value="Sent Messages" class="btn btn-success btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
{{--</div>--}}
@endsection
@push('comCustomScripts')
    <script>
        $("#organization_id").select2({
            placeholder: 'Select Organization',
            allowClear: true
        })
    </script>
@endpush
