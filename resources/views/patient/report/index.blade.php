@extends('layouts.master')
@section('content')

    <!-- Start Patient History Model -->
    <div class="row mt-3 justify-content-center">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header text-center align-self-center bg-transparent">
                    <h4>Popular Diagnostic Center</h4>
                    <h4>117 Jb Dhanola</h4>
                    <h4>Tel: 01700000</h4>
                    <img src="{{asset('/img/logo.png')}}" width="100px">
                    <h4 style="font-weight: bold; margin-top: 20px; text-transform: uppercase;">
                        Lab Report
                        <hr style="border-bottom: 1px solid #000; margin-top: 5px; margin-bottom: 5px;">
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 justify-content-between" style="text-align: left;">
                            <p>
                                <label>Patient Name</label>
                                <span>: TEST</span>
                            </p>
                            <p>
                                <label>Patient ID</label>
                                <span>: 1956</span>
                            </p>
                            <p>
                                <label>Phone</label>
                                <span>:+8801700000</span>
                            </p>
                            <p>
                                <label>Address</label>
                                <span>: East Badda</span>
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p>
                                <label>Patient Name</label>
                                <span>: TEST</span>
                            </p>
                            <p>
                                <label>Date</label>
                                <span>: 12/12/2021</span>
                            </p>
                            <p>
                                <label>Doctor</label>
                                <span>: Dr. Rony</span>
                            </p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-12">
                            <table class="table-striped text-center" border="1" width="100%">
                                <thead>
                                <tr>
                                    <th>Test</th>
                                    <th>Results</th>
                                    <th>Mark</th>
                                    <th>Reference Interval</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>WBC/µl</td>
                                    <td>10</td>
                                    <td>15</td>
                                    <td>4,500-16,000</td>
                                </tr>
                                <tr>
                                    <td>WBC/µl</td>
                                    <td>10</td>
                                    <td>15</td>
                                    <td>4,500-16,000</td>
                                </tr>
                                <tr>
                                    <td>WBC/µl</td>
                                    <td>10</td>
                                    <td>15</td>
                                    <td>4,500-16,000</td>
                                </tr>
                                <tr>
                                    <td>WBC/µl</td>
                                    <td>10</td>
                                    <td>15</td>
                                    <td>4,500-16,000</td>
                                </tr>
                                <tr>
                                    <td>WBC/µl</td>
                                    <td>10</td>
                                    <td>15</td>
                                    <td>4,500-16,000</td>
                                </tr>
                                <tr>
                                    <td>WBC/µl</td>
                                    <td>10</td>
                                    <td>15</td>
                                    <td>4,500-16,000</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4 justify-content-start">
            <div class="text-left" style="display: inline-grid;">
                <span class="text-dark"> Patient List</span>
                <a href="#" class="btn btn-info f-11 mb-1" data-toggle="modal" data-target="#"><i class="fas fa-edit"></i>&nbsp;Print</a>
                <a href="#" class="btn btn-info f-11 mb-1" data-toggle="modal" data-target="#"><i class="fas fa-edit"></i>&nbsp;Downlode</a>
                <a href="#" class="btn btn-danger f-11 mb-1" data-toggle="modal" data-target="#"><i class="fas fa-trash-alt"></i>&nbsp;Edit Report</a>
            </div>
        </div>
    </div>
    <!-- End Patient History Model -->

{{--    <!-- Start Edit Patient History Model -->--}}
{{--    <div class="modal fade" id="editPatientHistory">--}}
{{--        <div class="modal-dialog modal-lg modal-dialog-centered">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header bg-dark">--}}
{{--                    <h4 class="modal-title text-light">Edit Patient Histor</h4>--}}
{{--                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>--}}
{{--                </div>--}}
{{--                <div class="modal-body row">--}}
{{--                    <form role="form" action="" class="clearfix" method="post" enctype="multipart/form-data" style="width: 100%; display: contents;">--}}
{{--                        <div class="form-group col-md-4">--}}
{{--                            <label>Patient Name</label>--}}
{{--                            <input type="text" name="name" class="form-control" placeholder="Name" required>--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-md-4">--}}
{{--                            <label>Phone</label>--}}
{{--                            <input type="text" name="phone" class="form-control" placeholder="+880" required>--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-md-4">--}}
{{--                            <label>Guardian Name</label>--}}
{{--                            <input type="text" name="name" class="form-control" placeholder="Name">--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-md-4">--}}
{{--                            <label>Gender</label>--}}
{{--                            <select name="gender" class="form-control">--}}
{{--                                <option value="" disabled >Withdraw Type Select........</option>--}}
{{--                                <option value="1">Mam</option>--}}
{{--                                <option value="2">Woman</option>--}}
{{--                                <option value="3">Other</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-md-4">--}}
{{--                            <label>Birth Date</label>--}}
{{--                            <input type="date" name="data" class="form-control" placeholder="Data">--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-md-4">--}}
{{--                            <label>Blood Group</label>--}}
{{--                            <select name="num" class="form-control">--}}
{{--                                <option value="" disabled >Select Your Blood Group........</option>--}}
{{--                                <option value="1">A+</option>--}}
{{--                                <option value="2">A-</option>--}}
{{--                                <option value="3">B+</option>--}}
{{--                                <option value="4">B-</option>--}}
{{--                                <option value="5">O+</option>--}}
{{--                                <option value="6">O-</option>--}}
{{--                                <option value="7">AB</option>--}}
{{--                                <option value="8">AB+</option>--}}
{{--                                <option value="9">AB-</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-md-4">--}}
{{--                            <label>Email</label>--}}
{{--                            <input type="email" name="email" class="form-control" placeholder="E-mail">--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-md-4">--}}
{{--                            <label>Address</label>--}}
{{--                            <textarea type="text" name="address" class="form-control" placeholder="Address" rows="2"></textarea>--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-md-4">--}}
{{--                            <label>Patient Images</label>--}}
{{--                            <input type="file" class="default" name="Patient_image">--}}
{{--                        </div>--}}

{{--                        <div class="form-group mb-20 col-md-4 offset-md-4">--}}
{{--                            <input type="submit" name="editPatientHistoryBtn" id="" value="Update Patient Data" class="btn btn-success btn-block btn-lg">--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- End Edit Patient History Model -->--}}

{{--    <!-- Start Add New Appointments Model -->--}}
{{--    <div class="modal fade" id="addAppointmentsHistory">--}}
{{--        <div class="modal-dialog modal-dialog-centered">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header bg-light">--}}
{{--                    <h4 class="modal-title text-dark">Add New Appointments</h4>--}}
{{--                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>--}}
{{--                </div>--}}
{{--                <div class="modal-body row">--}}
{{--                    <form role="form" action="" class="clearfix" method="post" enctype="multipart/form-data" style="width: 100%; display: contents;">--}}
{{--                        <div class="form-group col-sm-6">--}}
{{--                            <label>Patient</label>--}}
{{--                            <select name="Patient" class="form-control">--}}
{{--                                <option value="1">Rony(ID001)</option>--}}
{{--                                <option value="2">Micd(ID002)</option>--}}
{{--                                <option value="3">Abcd(ID003)</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-sm-6">--}}
{{--                            <label>Select Doctors</label>--}}
{{--                            <select name="doctor" class="form-control">--}}
{{--                                <option value="" disabled >Withdraw Type Select........</option>--}}
{{--                                <option value="1">Ms.Xxx</option>--}}
{{--                                <option value="2">Ms.Yyy</option>--}}
{{--                                <option value="3">Mrs.Zzz</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-sm-6">--}}
{{--                            <label>Date</label>--}}
{{--                            <input type="date" name="data" class="form-control" placeholder="Data">--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-sm-6">--}}
{{--                            <label>Available Slots</label>--}}
{{--                            <input type="time" name="time" class="form-control" placeholder="E-mail">--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-sm-6">--}}
{{--                            <label>Status</label>--}}
{{--                            <select name="status" class="form-control">--}}
{{--                                <option value="1">Complete</option>--}}
{{--                                <option value="2">Not Complete</option>--}}
{{--                                <option value="3">Mrs.Zzz</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-sm-6">--}}
{{--                            <label>Remarks</label>--}}
{{--                            <textarea type="text" name="remarks" class="form-control" placeholder="Address" rows="2"></textarea>--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-sm-12">--}}
{{--                            <input type="checkbox" name="sms">--}}
{{--                            <label>Send SMS</label>--}}
{{--                        </div>--}}

{{--                        <div class="form-group mb-20 col-sm-6 offset-3">--}}
{{--                            <input type="submit" name="editAppointmentsHistoryBtn" id="" value="Update" class="btn btn-success btn-block btn-lg">--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- End Add New Appointments History Model -->--}}

{{--    <!-- Start Edit Appointments Model -->--}}
{{--    <div class="modal fade" id="editAppointmentsHistory">--}}
{{--        <div class="modal-dialog modal-dialog-centered">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header bg-light">--}}
{{--                    <h4 class="modal-title text-dark">Update Appointments</h4>--}}
{{--                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>--}}
{{--                </div>--}}
{{--                <div class="modal-body row">--}}
{{--                    <form role="form" action="" class="clearfix" method="post" enctype="multipart/form-data" style="width: 100%; display: contents;">--}}
{{--                        <div class="form-group col-sm-6">--}}
{{--                            <label>Patient</label>--}}
{{--                            <select name="Patient" class="form-control">--}}
{{--                                <option value="1">Rony(ID001)</option>--}}
{{--                                <option value="2">Micd(ID002)</option>--}}
{{--                                <option value="3">Abcd(ID003)</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-sm-6">--}}
{{--                            <label>Select Doctors</label>--}}
{{--                            <select name="doctor" class="form-control">--}}
{{--                                <option value="" disabled >Withdraw Type Select........</option>--}}
{{--                                <option value="1">Ms.Xxx</option>--}}
{{--                                <option value="2">Ms.Yyy</option>--}}
{{--                                <option value="3">Mrs.Zzz</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-sm-6">--}}
{{--                            <label>Date</label>--}}
{{--                            <input type="date" name="data" class="form-control" placeholder="Data">--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-sm-6">--}}
{{--                            <label>Available Slots</label>--}}
{{--                            <input type="time" name="time" class="form-control" placeholder="E-mail">--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-sm-6">--}}
{{--                            <label>Status</label>--}}
{{--                            <select name="status" class="form-control">--}}
{{--                                <option value="1">Complete</option>--}}
{{--                                <option value="2">Not Complete</option>--}}
{{--                                <option value="3">Mrs.Zzz</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-sm-6">--}}
{{--                            <label>Remarks</label>--}}
{{--                            <textarea type="text" name="remarks" class="form-control" placeholder="Address" rows="2"></textarea>--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-sm-12">--}}
{{--                            <input type="checkbox" name="sms">--}}
{{--                            <label>Send SMS</label>--}}
{{--                        </div>--}}

{{--                        <div class="form-group mb-20 col-sm-6 offset-3">--}}
{{--                            <input type="submit" name="editAppointmentsHistoryBtn" id="" value="Update" class="btn btn-success btn-block btn-lg">--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- End Edit Appointments History Model -->--}}

{{--    <!-- Start Add New Case History Model -->--}}
{{--    <div class="modal fade" id="addCaseHistory">--}}
{{--        <div class="modal-dialog modal-dialog-centered">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header bg-light">--}}
{{--                    <h4 class="modal-title text-dark">Add New</h4>--}}
{{--                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>--}}
{{--                </div>--}}
{{--                <div class="modal-body row">--}}
{{--                    <form role="form" action="" class="clearfix" method="post" enctype="multipart/form-data" style="width: 100%; display: contents;">--}}
{{--                        <div class="form-group col-sm-12">--}}
{{--                            <label>Title</label>--}}
{{--                            <input type="text" name="title" class="form-control" placeholder="Data">--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-sm-12">--}}
{{--                            <label>Description</label>--}}
{{--                            <textarea type="text" name="description" class="form-control" placeholder="Description" rows="2"></textarea>--}}
{{--                        </div>--}}

{{--                        <div class="form-group mb-20 col-sm-6 offset-3">--}}
{{--                            <input type="submit" name="addCaseHistoryBtn" id="" value="Update" class="btn btn-success btn-block btn-lg">--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- End Add New Case History Model -->--}}

{{--    <!-- Start Edit Case History Model -->--}}
{{--    <div class="modal fade" id="editCaseHistory">--}}
{{--        <div class="modal-dialog modal-dialog-centered">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header bg-light">--}}
{{--                    <h4 class="modal-title text-dark">Edit New</h4>--}}
{{--                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>--}}
{{--                </div>--}}
{{--                <div class="modal-body row">--}}
{{--                    <form role="form" action="" class="clearfix" method="post" enctype="multipart/form-data" style="width: 100%; display: contents;">--}}
{{--                        <div class="form-group col-sm-12">--}}
{{--                            <label>Title</label>--}}
{{--                            <input type="text" name="title" class="form-control" placeholder="Data">--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-sm-12">--}}
{{--                            <label>Description</label>--}}
{{--                            <textarea type="text" name="description" class="form-control" placeholder="Description" rows="2"></textarea>--}}
{{--                        </div>--}}

{{--                        <div class="form-group mb-20 col-sm-6 offset-3">--}}
{{--                            <input type="submit" name="editCaseHistoryBtn" id="" value="Update" class="btn btn-success btn-block btn-lg">--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- End Edit Case History Model -->--}}

@endsection
