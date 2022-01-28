@extends('layouts.master')
@section('content')
    <!-- Start Test List Model -->
    <div class="row justify-content-center">
        <div class="col-lg-12 m-3">
            <div class="card border-success">

                <h4 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light align-self-center">Edit Test</span>
                </h4>
                <div class="card-body f-13">
                    <div class="row">
                        <form role="form" id="editForm" action="{{route('test.patient.update', $data->id)}}"
                              method="POST" class="clearfix" style="width: 100%; display: contents;">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="organization_id" id="organization_id">
                            <div class="col-sm-12">
                                <div class="bg-secondary p-lg-2 d-flex justify-content-between">
                                    <span
                                        class="text-light align-self-center font-weight-bold">Select Patient Area</span>
                                </div>
                                <div class="row pb-2">
                                    <div class="form-group col-sm-12">
                                        <label class="form-label font-weight-bold">Search Patient By Number</label>
                                        <input type="text" id="patient_search" name="patient_search"
                                               class="form-control form-control-sm border-dark"/>
                                        <ul class="dropdown" id="patient_search_result"></ul>
                                    </div>
                                    <input type="text" id="patient_id" name="patient_id"
                                           value="{{ old('patient_id', $data->patients->id) }}" hidden>

                                    <div class="form-group col-sm-4">
                                        <label class="font-weight-bold">First Name:</label>
                                        <input type="text" id="first_name" name="first_name" class="form-control"
                                               value="{{ old('first_name', $data->patients->first_name) }}"
                                               required>
                                        @if ($errors->has('first_name'))
                                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label class="font-weight-bold">Last Name:</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control"
                                               value="{{ old('last_name', $data->patients->last_name) }}"
                                               required>
                                        @if ($errors->has('last_name'))
                                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label class="font-weight-bold">Age:</label>
                                        <input type="number" name="age" id="age" class="form-control"
                                               value="{{ old('age', $data->patients->age) }}"
                                               required>
                                        @if ($errors->has('age'))
                                            <span class="text-danger">{{ $errors->first('age') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label class="font-weight-bold">Contact:</label>
                                        <input type="text" name="phone_number" id="phone_number"
                                               class="form-control"
                                               value="{{ old('phone_number', $data->patients->phone_number) }}"
                                               required>
                                        @if ($errors->has('phone_number'))
                                            <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label class="font-weight-bold">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option hidden
                                                    value="{{ $data->patients->gender }}">{{ ucfirst($data->patients->gender) }}</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                        @if ($errors->has('gender'))
                                            <span class="text-danger">{{ $errors->first('gender') }}</span>
                                        @endif
                                    </div>


                                    <div class="form-group col-sm-4">
                                        <label class="font-weight-bold">Address</label>
                                        <textarea type="text" name="address" id="address" class="form-control"
                                                  placeholder="Address" rows="2">{{ old('address', $data->patients->address) }}</textarea>
                                        @if ($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

{{--                            @if($data->referred_doctor_id != null)--}}

                                <div class="col-sm-12">
                                    <div class="bg-secondary p-lg-2 d-flex justify-content-between">
                                    <span
                                        class="text-light align-self-center font-weight-bold">Select Doctor Area</span>
                                    </div>
                                    <div class="row pb-2">
                                        <div class="form-group col-sm-12">
                                            <label class="form-label font-weight-bold">Search Doctor By Number</label>
                                            <input type="text" id="doctor_search" name="doctor_search"
                                                   class="form-control form-control-sm border-dark"/>
                                            <ul class="dropdown" id="doctor_search_result"></ul>
                                        </div>

                                        <input type="text" id="referred_doctor_id" name="referred_doctor_id"
                                               value="{{  $data->referredDoctors->id ?? '' }}"
                                               hidden>

                                        <div class="form-group col-sm-6">
                                            <label class="font-weight-bold">Name:</label>
                                            <input type="text" name="doctor_name" id="doctor_name" class="form-control"
                                                   value="{{ $data->referredDoctors->name ?? '' }}"
                                                   placeholder="Name">
                                            @if ($errors->has('doctor_name'))
                                                <span class="text-danger">{{ $errors->first('doctor_name') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="font-weight-bold">Institution Name:</label>
                                            <input type="text" name="institution_name" id="institution_name"
                                                   class="form-control"
                                                   value="{{  $data->referredDoctors->institution_name ?? '' }}"
                                                   placeholder="Institution">
                                            @if ($errors->has('institution_name'))
                                                <span
                                                    class="text-danger">{{ $errors->first('institution_name') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="font-weight-bold">Contact:</label>
                                            <input type="text" name="doctor_contact_number" id="doctor_contact_number"
                                                   class="form-control"
                                                   value="{{ old('phone_number', $data->referredDoctors->phone_number ?? '') }}"
                                                   placeholder="Contact">
                                            @if ($errors->has('doctor_contact_number'))
                                                <span
                                                    class="text-danger">{{ $errors->first('doctor_contact_number') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="font-weight-bold">Degree:</label>
                                            <input type="text" name="degree" id="degree" class="form-control"
                                                   value="{{ old('degree', $data->referredDoctors->degree ?? '') }}"
                                                   placeholder="Degree">
                                            @if ($errors->has('degree'))
                                                <span class="text-danger">{{ $errors->first('degree') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                </div>
{{--                            @endif--}}
                            <div class="col-sm-12">
                                <div class="bg-secondary p-lg-2 d-flex justify-content-between">
                                    <span class="text-light align-self-center">Create Test</span>
                                    <a href="#" id="createFormBtn" class="btn btn-light" data-toggle="modal"
                                       data-target="#add"><i
                                            class="fas fa-plus-circle"></i>&nbsp; ADD</a>
                                </div>
                                <div>
                                    <span class="text-danger pt-2" id="same-test"></span>
                                </div>
                                <div class="card-body f-13">
                                    <div class="table-responsive" id="">
                                        <table class="table table-striped text-canter" id="testTable">
                                            <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Test Name</th>
                                                <th>Delivery Date</th>
                                                <th>Delivery Time</th>
                                                <th>Option</th>
                                            </tr>
                                            </thead>
                                            <tbody id="testTableBody">
                                            @foreach($data->patientTestItems as $item)

                                                <tr>
                                                    <td>{{ ++$loop->index }}</td>
                                                    <td>{{ $item->tests->name }}</td>
                                                    <td>
                                                        @if($item->delivery_date != null)
                                                            {{ normalDateFormat($item->delivery_date) }}
                                                        @else()
                                                            {{__('Not Given')}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($item->delivery_time != null)
                                                            {{ normalTimeFormat($item->delivery_time) }}
                                                        @else()
                                                            {{__('Not Given')}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-danger remove"
                                                                onclick="deleteRow(this)" type="button">Remove
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <input type="text" id="test_item_id" name="test_item_id[]" hidden>
                                        <input type="text" id="test_name" name="test_name[]" hidden>
                                        <input type="text" id="test_price" name="test_price[]" hidden>
                                        <input type="text" id="d_date" name="d_date[]" hidden>
                                        <input type="text" id="d_time" name="d_time[]" hidden>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-3 col-sm-4 offset-sm-4">
                                <input type="submit" name="submit" value="Submit" id="editBtn"
                                       class="btn btn-success btn-block btn-lg">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Test Model -->

    @include('test.patient.createTest')
@endsection
@push('customScripts')
    <script>
        $("input[name*='doctor_name']").keyup(function () {
            let value_input = $("input[name*='doctor_name']").val();

            let regexp = /[^a-zA-Z. ]/g;
            if (value_input.match(regexp)) {
                $("input[name*='doctor_name']").val(value_input.replace(regexp, ''))
            }
        });
        $("input[name*='institution_name']").keyup(function () {
            let value_input = $("input[name*='institution_name']").val();
            let regexp = /[^a-zA-Z. ]/g;
            if (value_input.match(regexp)) {
                $("input[name*='institution_name']").val(value_input.replace(regexp, ''))
            }
        });
        $("input[name*='degree']").keyup(function () {
            let value_input = $("input[name*='degree']").val();
            let regexp = /[^a-zA-Z. ]/g;
            if (value_input.match(regexp)) {
                $("input[name*='degree']").val(value_input.replace(regexp, ''))
            }
        });
        $("input[name*='doctor_contact_number']").keyup(function () {
            let value_input = $("input[name*='doctor_contact_number']").val();
            let regexp = /[^0-9+]/g;
            if (value_input.match(regexp)) {
                $("input[name*='doctor_contact_number']").val(value_input.replace(regexp, ''))
            }
        });




        var testResult;
        var result;
        var doctorResult;
        var i;
        var test_id_array = [];
        var title_array = [];
        var price_array = [];
        var delivery_date_array = [];
        var delivery_time_array = [];

        $("input[name*='patient_search']").keyup(function () {
            let value_input = $("input[name*='patient_search']").val();
            let regexp = /[^0-9+]/g;
            if (value_input.match(regexp)) {
                $("input[name*='patient_search']").val(value_input.replace(regexp, ''))
            }

            $("#patient_search_error").text('');
        });

        $("input[name*='doctor_search']").keyup(function () {
            let value_input = $("input[name*='doctor_search']").val();
            let regexp = /[^0-9+]/g;
            if (value_input.match(regexp)) {
                $("input[name*='doctor_search']").val(value_input.replace(regexp, ''))
            }

            $("#doctor_search_error").text('');
        });

        // $("input[name*='test_search']").keyup(function () {
        //     let value_input = $("input[name*='test_search']").val();
        //     let regexp = /[^a-zA-Z +]/g;
        //     if (value_input.match(regexp)) {
        //         $("input[name*='test_search']").val(value_input.replace(regexp, ''))
        //     }
        //
        //     $("#test_search_error").text('');
        // });

        //Start JS For Patient Search And Autofill


        function getPatientDataBySelect(index) {

            var info = result[index];

            $("input[name*='patient_id']").val(info.id);
            $("input[name*='first_name']").val(info.first_name).attr({'disabled': 'disabled'});
            $("input[name*='last_name']").val(info.last_name).attr({'disabled': 'disabled'});
            $("input[name*='phone_number']").val(info.phone_number).attr({'disabled': 'disabled'});
            $("input[name*='age']").val(info.age).attr({'disabled': 'disabled'});
            $("select[name*='gender']").val(info.gender).attr({'disabled': 'disabled'});
            $("select[name*='religion']").val(info.religion).attr({'disabled': 'disabled'});
            $("textarea[name*='address']").val(info.address).attr({'disabled': 'disabled'});

            $("input[name*='patient_search']").val(info.phone_number);
            $('#patient_search_result').empty();

        }

        $("input[name*='patient_search']").keyup(function () {
            let patient_search = $("input[name*='patient_search']").val();
            if (patient_search.length === 0) {
                $("input[name*='patient_id']").val("");
                $("input[name*='first_name']").val("").removeAttr('disabled');
                $("input[name*='last_name']").val("").removeAttr('disabled');
                $("input[name*='phone_number']").val("").removeAttr('disabled');
                $("input[name*='age']").val("").removeAttr('disabled');
                $("select[name*='gender']").val("").removeAttr('disabled');
                $("select[name*='religion']").val("").removeAttr('disabled');
                $("textarea[name*='address']").val("").removeAttr('disabled');
            }
            if (patient_search.length > 2) {

                // now try to get data from database by AJAX....
                $.ajax({
                    url: '/test/patient/getPatient',
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        search: patient_search
                    },

                    success: function (response) {
                        // console.log('Success Response')
                        // console.log(response)
                        // console.log(typeof (response))

                        $('#patient_search_result').empty();

                        result = response
                        // console.log("Result: ")
                        // console.log(typeof (result[1]))
                        // console.log(result[1])

                        for (i = 0; i <= result.length - 1; i++) {
                            // console.log("count")
                            // console.log(i)
                            var li = '<li onclick="getPatientDataBySelect(' + i + ')" class="dropdown-item fa-border" style="display: block; font-size: larger">' + result[i].first_name + ' ' + result[i].last_name + '  (' + result[i].phone_number + ')</li>'

                            $('#patient_search_result').append(li);     // append li to ul.
                        }


                    }
                    ,
                    error: function (xhr, status, error) {
                        let errors = JSON.parse(xhr.responseText);
                        let errorName = errors.errors.name[0];
                        console.log(error)
                    }
                    ,

                })
            }
        });

        //End JS For Patient Search And Autofill


        //Start JS For Doctor Search And Autofill

        function getDoctorDataBySelect(index) {

            var doctorInfo = doctorResult[index];

            $("input[name*='referred_doctor_id']").val(doctorInfo.id);
            $("input[name*='doctor_name']").val(doctorInfo.name).attr({'disabled': 'disabled'});
            $("input[name*='institution_name']").val(doctorInfo.institution_name).attr({'disabled': 'disabled'});
            $("input[name*='doctor_contact_number']").val(doctorInfo.phone_number).attr({'disabled': 'disabled'});
            $("input[name*='degree']").val(doctorInfo.degree).attr({'disabled': 'disabled'});

            $("input[name*='doctor_search']").val(doctorInfo.phone_number);
            $('#doctor_search_result').empty();

        }

        $("input[name*='doctor_search']").keyup(function () {
            let doctor_search = $("input[name*='doctor_search']").val();
            if (doctor_search.length === 0) {
                $("input[name*='referred_doctor_id']").val("");
                $("input[name*='doctor_name']").val("").removeAttr('disabled');
                $("input[name*='institution_name']").val("").removeAttr('disabled');
                $("input[name*='doctor_contact_number']").val("").removeAttr('disabled');
                $("input[name*='degree']").val("").removeAttr('disabled');
            }
            if (doctor_search.length > 2) {

                // now try to get data from database by AJAX...
                $.ajax({
                    url: '/test/patient/getDoctor',
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        search: doctor_search
                    },

                    success: function (response) {
                        // console.log('Success Response')
                        // console.log(response)
                        // console.log(typeof (response))

                        $('#doctor_search_result').empty();

                        doctorResult = response
                        // console.log("Result: ")
                        // console.log(typeof (doctorResult[1]))
                        // console.log(doctorResult[1])

                        for (i = 0; i <= doctorResult.length - 1; i++) {
                            // console.log("count")
                            // console.log(i)
                            var li = '<li onclick="getDoctorDataBySelect(' + i + ')" class="dropdown-item fa-border" style="display: block; font-size: larger">' + doctorResult[i].name + '   (' + doctorResult[i].phone_number + ')</li>'

                            $('#doctor_search_result').append(li);     // append li to ul.
                        }
                    }
                    ,
                    error: function (xhr, status, error) {
                        let errors = JSON.parse(xhr.responseText);
                        let errorName = errors.errors.name[0];
                        console.log(error)
                    }
                    ,

                })
            }

        });

        //End JS For Doctor Search And Autofill


        //Start JS For Test Search And Autofill

        function getTestDataBySelect(index) {

            var testInfo = testResult[index];

            $("input[name*='test_id']").val(testInfo.id);
            $("input[name*='title']").val(testInfo.name).attr({'disabled': 'disabled'});
            $("input[name*='price']").val(testInfo.price).attr({'disabled': 'disabled'});

            $("input[name*='test_search']").val(testInfo.name);
            $('#test_search_result').empty();

            // $("input[name*='test_item_id[]']").val(testInfo.id);
            // $("input[name*='test_name[]']").val(testInfo.name);
            // $("input[name*='test_price[]']").val(testInfo.price);
            // console.log("testInfo.id")
            // console.log(testInfo.id)
        }

        $("input[name*='test_search']").keyup(function () {
            let test_search = $("input[name*='test_search']").val();
            if (test_search.length === 0) {
                $("input[name*='test_id']").val("");
                $("input[name*='title']").val("");
                $("input[name*='price']").val("");
            }
            if (test_search.length >= 2) {

                // now try to get data from database by AJAX....
                $.ajax({
                    url: '/test/patient/getTest',
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        search: test_search
                    },

                    success: function (response) {
                        console.log('Success Response')
                        // console.log(response)
                        // console.log(typeof (response))

                        $('#test_search_result').empty();

                        testResult = response
                        // console.log("Result: ")
                        // console.log(typeof (testResult[1]))
                        // console.log(testResult[1])

                        for (i = 0; i <= testResult.length - 1; i++) {
                            // console.log("count")
                            // console.log(i)
                            var li = '<li onclick="getTestDataBySelect(' + i + ')" class="dropdown-item fa-border" style="display: block; font-size: larger">' + testResult[i].name + '   (' + testResult[i].price + ')</li>'

                            $('#test_search_result').append(li);     // append li to ul.
                        }
                    }
                    ,
                    error: function (xhr, status, error) {
                        let errors = JSON.parse(xhr.responseText);
                        let errorName = errors.errors.name[0];
                        console.log(error)
                    }
                    ,

                })
            }

        });
        //End JS For Test Search And Autofill


        $('#createTestBtn').click(function (data) {
            $('#add').modal('hide');
            console.log('Test Created')
            var test_id = $("input[name*='test_id']").val();
            var title = $("input[name*='title']").val();
            var price = $("input[name*='price']").val();
            var delivery_date = $("input[name*='delivery_date']").val();
            var delivery_time = $("input[name*='delivery_time']").val();

            $("input[name*='test_search']").val("")
            $("input[name*='title']").val("")
            $("input[name*='price']").val("");
            $("input[name*='delivery_date']").val("");
            $("input[name*='delivery_time']").val("");

            // function findValueInRow() {
                table = document.getElementById("testTable");
                var rows = table.rows;
                for (var i = 1; i < rows.length; i++) {
                    var cols = rows[i].cells;
                    for (var c = 0; c < cols.length; c++) {
                        if (cols[c].innerText == title) {
                            document.getElementById("same-test").innerHTML="<b>Already Done This Test Before.If You Don't Need To Do The Same Test Than Please Delete It.</b>";
                            $("#same-test").show().delay(10000).fadeOut();
                            // return cols[0].innerHTML;
                            // return;
                        }
                        // return '',
                        // else {
                        //     findDataInArray();
                        // }
                    }
                }
                // return '';
            // }

             // $("#table-same-test").val();
            // Check if the test item was selected before

            // function findDataInArray() {
                if (title_array.indexOf(title) !== -1) {

                    document.getElementById("same-test").innerHTML = "<b>This Test Is Already Selected</b>";
                    $("#same-test").show().delay(2000).fadeOut();

                }
                else {
                    test_id_array.push(test_id);
                    title_array.push(title);
                    price_array.push(price);
                    delivery_date_array.push(delivery_date);
                    delivery_time_array.push(delivery_time);


                    $("#test_item_id").val(test_id_array);
                    $("#test_name").val(title_array);
                    $("#test_price").val(price_array);
                    $("#d_date").val(delivery_date_array);
                    $("#d_time").val(delivery_time_array);

                    time = delivery_time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

                    if (time.length > 1) { // If time format correct
                        time = time.slice(1);  // Remove full string match value
                        time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
                        time[0] = +time[0] % 12 || 12; // Adjust hours
                    }
                    delivery_time = time.join(''); // return adjusted time or original string

                    var table = document.getElementById("testTableBody");
                    var row = table.insertRow();
                    var sl = row.insertCell(0);
                    var name = row.insertCell(1);
                    var date = row.insertCell(2);
                    var time = row.insertCell(3);
                    var action = row.insertCell(4);
                    var removeBtn = '<button class="btn btn-sm btn-danger remove" onclick="deleteRow(this)" type="button">Remove</button>'
                    sl.innerHTML = table.childElementCount;
                    name.innerHTML = title;
                    date.innerHTML = delivery_date;
                    time.innerHTML = delivery_time;
                    action.innerHTML = removeBtn;
                    // i++
                    // console.log(delivery_date)
                }
            // }
        });

        function deleteRow(item) {
            console.log(item.parentElement.parentElement.rowIndex)
            var rowIndex = item.parentElement.parentElement.rowIndex;

            test_id_array.splice(rowIndex - 1, 1);
            title_array.splice(rowIndex - 1, 1);
            price_array.splice(rowIndex - 1, 1);
            delivery_date_array.splice(rowIndex - 1, 1);
            delivery_time_array.splice(rowIndex - 1, 1);

            item.parentElement.parentElement.remove();

            var table = document.getElementById("testTableBody");
            var sl = 1;
            for (var index = 0; index < table.rows.length; index++) {
                table.rows[index].cells[0].innerHTML = sl;
                sl++;
            }
        }

    </script>
@endpush
