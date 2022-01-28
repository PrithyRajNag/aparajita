@extends('layouts.master')
@section('content')
<!-- Start Patient History Model -->
<div class="row mt-3 justify-content-center">
    <div class="col-sm-3">
        <div class="card profile-nav">
            <h4 class="card-header bg-transparent d-flex justify-content-between">
                <span class="text-color align-self-center">Patient Info</span>
            </h4>
            <div class="card-body p-0">
                <div class="col-sm-12 mb-3">
                    <img src="{{getUserImage($patientInfo->image)}}" class="img-thumbnail mt-3" width="100%;" >
                    <div class="justify-content-between mt-3 text-center">
                        {{--<a href="#" class="btn btn-info f-11" data-toggle="modal" data-target="#editPatientHistor"><i class="fas fa-edit"></i>&nbsp;</a>--}}
                        {{--<a href="#" class="btn btn-danger f-11" data-toggle="modal" data-target="#"><i class="fas fa-trash-alt"></i>&nbsp;</a>--}}
                    </div>
                </div>
                <div class="nav flex-column p-0 border-top f-13">
                    {{--<li>Patient ID: <span class="float-right">PB8Z1YUT</span></li>--}}
                    <li>Name: <span class="float-right">{{ $patientInfo->full_name }}</span></li>
                    <li>Gender: <span class="float-right">{{ ucfirst($patientInfo->gender) }}</span></li>
                    <li>Phone: <span class="float-right">{{ $patientInfo->phone_number }}</span></li>
                    {{--<li>Admission Date: <span class="float-right">12/02/2020</span></li>--}}
                    {{--<li>Guardian Name: <span class="float-right">MS Ttttt</span></li>--}}
                    <li>Birth Date: <span class="float-right">{{ normalDateFormat($patientInfo->dob) }}</span></li>
                    {{--<li>Email: <span class="float-right">rock@amin.com</span></li>--}}
                    <li>Address: <span class="float-right mb-lg-5">{{ $patientInfo->address }}</span></li>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-9">
        <div class="card profile-area">
            <h4 class="card-header bg-transparent d-flex justify-content-between">
                <span class="text-dark align-self-center"> Patient History </span>
            </h4>
            <div class="card-body ">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a href="#appointments" class="nav-link active font-weight-bold" data-toggle="tab" aria-expanded="true">Appointments</a>
                        </li>

                        <li class="nav-item">
                            <a href="#case" class="nav-link font-weight-bold" data-toggle="tab" aria-expanded="true">Case History</a>
                        </li>

                        <li class="nav-item">
                            <a href="#labs" class="nav-link font-weight-bold" data-toggle="tab" aria-expanded="true">Lab</a>
                        </li>

                        <li class="nav-item">
                            <a href="#bed" class="nav-link font-weight-bold" data-toggle="tab" aria-expanded="true">Bed</a>
                        </li>

                        {{--<li class="nav-item">--}}
                            {{--<a href="#documents" class="nav-link font-weigth-bold" data-toggle="tab" aria-expanded="true">Documents</a>--}}
                        {{--</li>--}}
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- Start Appointments Detail Model -->
                        @include('patient.history.appointment.index')
                        <!-- End Appointments Detail Model -->

                        <!-- Start Case History Detail Model -->
                        @include('patient.history.case.index')
                        <!-- End Case History Detail Model -->

                        <!-- Start Lab Detail Model -->
                        @include('patient.history.lab.index')
                        <!-- End Lab Detail Model -->

                        <!-- Start Bed Detail Model -->
                        @include('patient.history.bed.index')
                        <!-- End Bed Detail Model -->

                        <!-- Start Documents Detail Model -->
                        {{--@include('patient.history.documents.index')--}}
                        <!-- End Documents Detail Model -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Patient History Model -->

<!-- Start Patient History Model -->
{{--@include('patient.history.edit')--}}
<!-- End Patient History Model -->

<!-- Start Add New Appointments Model -->
{{--@include('patient.history.appointment.create')--}}
<!-- End Add New Appointments History Model -->

<!-- Start Edit Appointments Model -->
{{--@include('patient.history.appointment.edit')--}}
<!-- End Edit Appointments History Model -->

<!-- Start Add New Case History Model -->
{{--@include('patient.history.case.create')--}}
<!-- End Add New Case History Model -->

<!-- Start Edit Case History Model -->
{{--@include('patient.history.case.edit')--}}
<!-- End Edit Case History Model -->
@endsection
