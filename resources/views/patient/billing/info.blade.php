@extends('layouts.master')
@section('content')

    <div class="info-content">
        <div class="modal-header bg-info">
            <h4 class="modal-title text-light">Patient Billing</h4>
        </div>
        <form role="form" class="clearfix" action="{{route('patient.billing.store',$patientInfo->id)}}" method="POST"
              enctype="multipart/form-data"
              style="width: 100%; display: contents;">
            @csrf
            <div class="personal_info">
                <h5>Personal Information</h5>
                <input type="text" name="patient_id" value="{{ $patientInfo->id }}" hidden>
                {{--                <input type="text" name="patient_billing_no" value="{{ !$data->patient_billing_no ? null : $data->patient_billing_no }}" hidden>--}}
                <div style="border: 1px solid black; padding: 5px">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="font-weight-bold">Name :</label>
                            <label>{{ $patientInfo->full_name }}</label>
                        </div>
                        <div class="col-md-4">
                            <label class="font-weight-bold">Age :</label>
                            <label>{{ $patientInfo->age }}</label>
                        </div>
                        <div class="col-md-4">
                            <label class="font-weight-bold">Gender :</label>
                            <label>{{ $patientInfo->gender }}</label>
                        </div>
                        <div class="col-md-4">
                            <label class="font-weight-bold">Phone Number :</label>
                            <label>{{ $patientInfo->phone_number }}</label>
                        </div>
                        @if($caseHistories == null)
                            <div class="col-md-4">
                                <label class="font-weight-bold">Date :</label>
                                <label>{{ normalDateFormat($dischargeDate->toDateString()) }}</label>
                            </div>
                        @endif
                        @if($caseHistories != null)
                            <div class="col-md-4">
                                <label class="font-weight-bold">Admit Date :</label>
                                <label>{{ normalDateFormat($caseHistories->admit_date) }}</label>
                            </div>
                            <div class="col-md-4">
                                <label class="font-weight-bold">Admit Time :</label>
                                <label>{{ normalTimeFormat($caseHistories->admit_time) }}</label>
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold">Discharge Date :</label>
                                <label>{{ normalDateFormat($dischargeDate->toDateString()) }}</label>
                            </div>
                            <div class="col-md-4">
                                <label class="font-weight-bold">Discharge Time :</label>
                                <label>{{ normalTimeFormat($dischargeDate->toTimeString()) }}</label>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @if($beds->isEmpty())
                <p></p>
            @else
                <div class="bed_info mt-3">
                    <h5>Bed Information</h5>
                    <table class="table table-striped text-canter">
                        <thead>
                        <tr>
                            <th style="width: 25%">Bed Number</th>
                            <th style="width: 25%">Start Date</th>
                            <th style="width: 25%">End Date</th>
                            <th style="width: 25%">Price</th>
                        </tr>
                        </thead>
                        <tbody id="bed_tbody">
                        @php
                            $bed_price = 0;
                        @endphp
                        @foreach($beds as $bed)

                            <tr>
                                <td style="width: 25%">
                                    <input type="text" name="name" class="" style="border: 0px"
                                           value="{{ $bed->bedList->bed_number }}" disabled>
                                </td>
                                <td style="width: 25%">{{ normalDateFormat($bed->start_date) }}</td>
                                <td style="width: 25%">{{ $bed->end_date != null ? normalDateFormat($bed->end_date) : normalDateFormat($dischargeDate->toDateString()) }}</td>
                                <td style="width: 25%">{{ (   ceil(abs(( strtotime($bed->start_date) - ($bed->end_date != null ? strtotime($bed->end_date) : strtotime($dischargeDate->toDateString())) )/ 86400 * $bed->bedList->price )) )   }}
                                </td>
                            </tr>
                            @php
                                $single = (ceil(abs(( strtotime($bed->start_date) - ($bed->end_date != null ? strtotime($bed->end_date) : strtotime($dischargeDate->toDateString())) )/ 86400 * $bed->bedList->price)));
                                $bed_price = $bed_price + $single;
                            @endphp
                        @endforeach
                        </tbody>
                    </table>
                    <input type="number" name="total_bed_price" class="form-control-sm"
                           value="{{ $bed_price }}" hidden>
                </div>
            @endif

            @if($tests==null)
                <p></p>
            @else
                <div class="test_info mt-3">
                    <h5>Test Information</h5>
                    <table class="table table-striped text-canter">
                        <thead>
                        <tr>
                            <th style="width: 25%">Test Name</th>
                            <th style="width: 25%">Input Date</th>
                            <th style="width: 25%">Delivery Date</th>
                            <th style="width: 25%">Price</th>
                        </tr>
                        </thead>
                        <tbody id="test_tbody">
                        <input type="number" name="total_test_price" class="form-control-sm"
                               value="{{ $tests->total_test_amount }}" hidden>
                        @foreach($tests as $test)
                            <tr>
                                <td style="width: 25%">
                                    <input name="name" class="" style="border: 0px;background: none"
                                           value="{{ $test->tests->name }}" disabled>
                                </td>
                                <td style="width: 25%">{{ normalDateFormat($test->input_date) }}</td>
                                <td style="width: 25%">{{ $test->delivery_date != null ? normalDateFormat($test->delivery_date) : normalDateFormat($dischargeDate->toDateString()) }}</td>
                                <td style="width: 25%">{{ $test->price }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            @endif

            <div class="service_info mt-3">
                <div class="">
                    <h5 class="d-inline">Service Charges</h5>
                    <button class="btn btn-outline-success float-right mb-2 add-service-row-btn" type="button"><i
                            class="glyphicon glyphicon-plus"></i>Add
                    </button>
                </div>
                <div class="row my-4 mx-0">
                    <div class="input-group service-increment">
                        <input style="border: 0px;padding-left: 5px" type="text"
                               class="form-control col-3 font-weight-bold"
                               value="Service Name" disabled>

                        <input style="border: 0px;padding-left: 5px" type="text"
                               class="form-control col-3 font-weight-bold"
                               value="Date" disabled>

                        <input style="border: 0px;padding-left: 5px" type="text"
                               class="form-control col-3 font-weight-bold"
                               value="Count" disabled>


                        <input style="border: 0px;padding-left: 5px" type="text"
                               class="form-control col-3 font-weight-bold" value="Price"
                               disabled>

                        <input name="total_service_price" id="total_service_price" type="text" value="0" hidden>
                    </div>
                    @if($services==null)
                        <p></p>
                    @else
                        <input type="number" name="given_service_total_price" class="form-control-sm"
                               value="{{ $services->total_service_amount }}" hidden>
                        @foreach($services as $service)
                            <input type="text" name="given_service_name" style="border: 0px;background: none"
                                   value="{{ $service->name }}" class="form-control-sm col-2 font-weight-bold" disabled>

                            <input type="date" name="given_service_date" style="border: 0px;background: none"
                                   value="{{ $service->date }}" class="form-control-sm offset-1 col-2 font-weight-bold"
                                   disabled>

                            <input type="number" name="given_service_count" style="border: 0px;background: none"
                                   value="{{ $service->count }}" class="form-control-sm offset-1 col-2 font-weight-bold"
                                   disabled>

                            <input type="number" name="given_service_price" style="border: 0px;background: none"
                                   value="{{ $service->amount }}"
                                   class="form-control-sm offset-1 col-2 font-weight-bold mr-5 " disabled>
                        @endforeach
                    @endif
                    <div class="clone hide control-group service-group input-group">
                        <div class="control-group input-group" style="margin-top:10px">
                            <input type="text" name="service_name[]" class="form-control-sm col-2 font-weight-bold">

                            <input type="date" name="service_date[]"
                                   class="form-control-sm offset-1 col-2 font-weight-bold">

                            <input type="number" name="service_count[]" value="1"
                                   class="form-control-sm offset-1 col-2 font-weight-bold">

                            <input type="number" name="service_price[]"
                                   onkeyup="calculate_service_price(this)"
                                   class="form-control-sm offset-1 col-2 font-weight-bold mr-2  service_price">
                            <button class="btn btn-sm btn-danger dlt-service-row-btn" type="button"><i
                                    class="glyphicon glyphicon-remove"></i> X
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {{--            <hr class="font-weight-bolder my-3"/>--}}
            @if($advances == null)
                {{--            @if($advances->isEmpty())--}}
                <p></p>
            @else
                <hr class="font-weight-bolder my-4"/>
                <div class="advance_info mt-3">
                    <h5>Advance Details</h5>
                    <table class="table table-striped text-canter">
                        <thead>
                        <tr>
                            <th style="width: 67%">Date</th>
                            <th style="width: 33%">Amount</th>
                        </tr>
                        </thead>
                        <tbody id="advance_tbody">
                        <input type="number" name="given_advance" class="form-control-sm" id="given_advance"
                               value="{{ !$advances->total_advance_amount? 0 : $advances->total_advance_amount }}"
                               hidden>
                        @foreach($advances as $advance)
                            <tr>
                                <td style="width: 67%">{{ normalDateFormat($advance->date) }}</td>
                                <td style="width: 33%">{{ $advance->amount }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <hr class="font-weight-bolder my-3"/>
            <div class="calculation">
                <div>
                    <label class="font-weight-bold col-8">Sub Total :</label>
                    <input type="number" name="sub_total" class="form-control-sm col-3 font-weight-bold " required>
                </div>
                @if ($errors->has('sub_total'))
                    <span class="text-danger">{{ $errors->first('sub_total') }}</span>
                @endif
                <div class="mt-2">
                    <label class="font-weight-bold col-8">Discount :</label>
                    <input type="number" name="discount" class="form-control-sm col-3 font-weight-bold "
                           onkeyup="calculate_gross_total(this)"><span class="font-weight-bolder ml-2">%</span>
                </div>
                <div class="mt-2">
                    <label class="font-weight-bold col-8">Gross Total :</label>
                    <input type="text" id="gross_total" onkeyup="calculate_discount(this)" name="gross_total"
                           class="form-control-sm col-3 font-weight-bold gross_total" required>
                </div>
                @if ($errors->has('gross_total'))
                    <span class="text-danger">{{ $errors->first('gross_total') }}</span>
                @endif
                <div class="mt-2">
                    <label class="font-weight-bold col-8">Due :</label>
                    <input type="text" id="due" name="due" class="form-control-sm col-3 font-weight-bold ">
                </div>
                <div class="mt-4">
                    <label class="font-weight-bold col-8">Advance :</label>
                    <input type="number" id="advance" name="advance" class="form-control-sm col-3 font-weight-bold">
                </div>
            </div>


            <hr class="font-weight-bolder my-4"/>

            <div class="final-calculation">
                <div class="mt-2">
                    <label class="font-weight-bold col-8">Total Paid : <input type="checkbox" name="full_paid"
                                                                              id="full_paid" value="Full Paid"
                                                                              onclick="fullPaid()"><span class="pl-2">Full Paid</span></label>
                    <input type="number" name="total_paid" id="total_paid"
                           class="form-control-sm col-3 font-weight-bold ">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" name="createBtn" id="createBtn" value="Save"
                        class="btn btn-success btn my-4">Save
                </button>
                <a href="{{route('patient.billing.pdf', $patientInfo->id ?? '')}}"
                   class="btn btn-info btn"><i
                        class="fas fa-file-pdf"></i>&nbsp;PDF</a>
            </div>
        </form>
    </div>

@endsection
@push('customScripts')
    <script>

        $("input[name*='gross_total']").keyup(function () {
            let value_input = $("input[name*='gross_total']").val();
            let regexp = /[^0-9.]/g;
            if (value_input.match(regexp)) {
                $("input[name*='gross_total']").val(value_input.replace(regexp, ''))
            }
        });

        $("input[name*='due']").keyup(function () {
            let value_input = $("input[name*='due']").val();
            let regexp = /[^0-9.]/g;
            if (value_input.match(regexp)) {
                $("input[name*='due']").val(value_input.replace(regexp, ''))
            }
        });


        var total_service_price = 0
        $(function () {
            calculate_sub_total();
        });

        $(document).ready(function () {

            calculate_service_price();

            $(".add-service-row-btn").click(function () {
                var html = $(".service-group").html();
                $(".service-increment").after(html);
            });


            $("body").on("click", ".dlt-service-row-btn", function () {
                let value = $(this).siblings(".service_price").val();
                let total_value = $("input[name*='total_service_price']").val();
                let updated_total = total_value - value
                $("input[name*='total_service_price']").val(updated_total);

                $(this).parents(".control-group").remove();

                calculate_sub_total();
                calculate_gross_total();
            });

        })

        function calculate_service_price() {

            var sum = 0;
            var total = 0;
            //iterate through each textboxes and add the values
            $(".service_price").each(function () {
                //add only if the value is number
                if (!isNaN(this.value) && this.value.length != 0) {
                    sum += parseFloat(this.value);
                } else if (this.value.length != 0) {
                    // $(this).css("background-color", "red");
                }
            });
            let given_service_price = Number($("input[name*='given_service_total_price']").val());

            if ($("input[name*='given_service_total_price']").val() == null) {
                given_service_price = 0;
            }
            total = sum + given_service_price;

            $("input[name*='total_service_price']").val(total);

            calculate_sub_total();
            calculate_gross_total();
        }

        function calculate_sub_total() {
            let total_test_price = Number($("input[name*='total_test_price']").val());
            let total_bed_price = Number($("input[name*='total_bed_price']").val());
            let total_service_price = Number($("input[name*='total_service_price']").val());

            if ($("input[name*='total_test_price']").val() == null) {
                total_test_price = 0;
            }
            if ($("input[name*='total_bed_price']").val() == null) {
                total_bed_price = 0;
            }


            let sub_total = total_bed_price + total_test_price + total_service_price;

            $("input[name*='sub_total']").val(sub_total);
        }

        function calculate_gross_total() {
            var discount = (Number($("input[name*='discount']").val()) / 100);
            var sub_total = Number($("input[name*='sub_total']").val());
            var given_advance = Number($("input[name*='given_advance']").val());

            console.log(given_advance)

            var gross_total = sub_total - (sub_total * discount)
            $("input[name*='gross_total']").val(gross_total);

                // if (given_advance.isNaN ){
                if (Object.is(given_advance, NaN) ){
                    $("input[name*='due']").val('');
                }else {
                    var due = gross_total - given_advance;
                    $("input[name*='due']").val(due)
                }
        }
        function calculate_discount(){
            var sub_total = Number($("input[name*='sub_total']").val());
            var gross_total = Number($("input[name*='gross_total']").val());
            var discount = ((((sub_total) - gross_total)/sub_total)*100);
            $("input[name*='discount']").val(discount);
            if (gross_total == ''){
                $("input[name*='discount']").val('');
            }
            calculate_gross_total();
        }


        $('#advance').on("input", (function (e) {
                var advance = e.target.value;
                var grossTotal = $('#gross_total').val();
                var given_advance = $('#given_advance').val();
                if (!$('#given_advance').val()) {
                    given_advance = 0
                }
                $('#due').val(Number(grossTotal) - (Number(advance) + Number(given_advance)))
                $('#total_paid').val(Number(advance) + Number(given_advance))
            })
        )

        function fullPaid() {
            // Get the checkbox
            var checkBox = document.getElementById("full_paid");
            var gross_total = $("input[name*='gross_total']").val();
            if (checkBox.checked == true) {
                $("input[name*='total_paid']").val(gross_total);
                document.getElementById('total_paid').readOnly = true;
            } else {
                $("input[name*='total_paid']").val();
                document.getElementById('total_paid').readOnly = false;
            }
        }
    </script>
@endpush


