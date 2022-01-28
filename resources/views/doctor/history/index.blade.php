@extends('layouts.master')
@section('content')
<!-- Start Doctor History Model -->
<div class="row mt-3 justify-content-center">
    <div class="col-sm-4">
        <div class="card profile-nav">
            <h4 class="card-header bg-transparent d-flex justify-content-between">
                <span class="text-color align-self-center">Doctor Information</span>
            </h4>
            <div class="card-body p-0">
                <div class="col-sm-12 mb-3">
                    <img src="{{getUserImage($doctorInfo->image)}}" class="img-thumbnail mt-3" width="100%;" >
                </div>
                <div class="nav flex-column p-0 border-top f-13">
                    <li>Employee ID: <span class="float-right">{{ $doctorInfo->user_unique_id  ?? '' }}</span></li>
                    <li>Section: <span class="float-right">{{ ucfirst($doctorInfo->doctorInfos->doctor_type ?? '') }}</span></li>
                    <li>Department: <span class="float-right">{{ $doctorInfo->doctorInfos->departments->name ?? '' }}</span></li>
                    <li>Name: <span class="float-right">{{ $doctorInfo->full_name ?? '' }}</span></li>
                    <li>Gender: <span class="float-right">{{ ucfirst($doctorInfo->gender ?? '') }}</span></li>
                    <li>Phone: <span class="float-right">{{ $doctorInfo->phone_number ?? '' }}</span></li>
                    <li>Blood Group: <span class="float-right">{{ $doctorInfo->bloodGroups->name ?? '' }}</span></li>
                    <li>Joining Date: <span class="float-right">{{ normalDateFormat($doctorInfo->join_date ?? '') }}</span></li>
                    <li>Birth Date: <span class="float-right">{{ normalDateFormat($doctorInfo->dob ?? '') }}</span></li>
                    <li>Email: <span class="float-right">{{ $doctorInfo->email ?? '' }}</span></li>
                    <li>Address: <span class="float-right mb-lg-5">{{ $doctorInfo->address ?? '' }}</span></li>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-8">
        <div class="card profile-area">
            <h4 class="card-header bg-transparent d-flex justify-content-between">
                <span class="text-dark align-self-center">Doctor History</span>
            </h4>
            <div class="card-body rounded-0">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a href="#appointments" class="nav-link active font-weight-bold" data-toggle="tab" aria-expanded="true">Appointments Calendar</a>
                        </li>

                        <li class="nav-item">
                            <a href="#case" class="nav-link font-weight-bold" data-toggle="tab" aria-expanded="true">Appointments List</a>
                        </li>

                        <li class="nav-item">
                            <a href="#time-schedule" class="nav-link font-weight-bold" data-toggle="tab" aria-expanded="true">Time Schedule</a>
                        </li>

                        <li class="nav-item">
                            <a href="#holiday" class="nav-link font-weight-bold" data-toggle="tab" aria-expanded="true">Holiday</a>
                        </li>

                        <li class="nav-item">
                            <a href="#documents" class="nav-link font-weight-bold" data-toggle="tab" aria-expanded="true">Documents</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- Start Appointments Calendar Model -->
                        @include('doctor.history.appointment_calender.index')
                        <!-- End Appointments Calendar Model -->

                        <!-- Start Appointments List Detail Model -->
                        @include('doctor.history.appointment_list.index')
                        <!-- End Case History Detail Model -->

                        <!-- Start Time Schedule Model -->
                        @include('doctor.history.time_schedule.index')
                        <!-- End Time Schedule Model -->

                        <!-- Start Doctor Holiday Model -->
                        @include('doctor.history.holiday.index')
                        <!-- End Doctor Holiday Model -->

                        <!-- Start Documents Detail Model -->
                        @include('doctor.history.document.index')
                        <!-- End Documents Detail Model -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Doctor History Model -->

<!-- Start Add New Doctor Time Schedule Model -->
@include('doctor.history.time_schedule.create')
<!-- End Add New Appointments History Model -->

<!-- Start Edit Appointments Model -->
@include('doctor.history.appointment_calender.edit')
<!-- End Edit Appointments History Model -->

<!-- Start Add New Doctor Holiday Model -->
@include('doctor.history.holiday.create')
<!-- End Add New Doctor Holiday Model -->

<!-- Start Edit Doctor Holiday Model -->
@include('doctor.history.holiday.edit')
<!-- End Edit Doctor Holiday Model -->

<!-- Start Add New Doctor Document Model -->
{{--@include('doctor.history.document.create')--}}
<!-- End Edit Add New Doctor Document Model -->

@endsection

@push('customScripts')
    <script>
        let doctor_id = "{{ request()->segment(2) }}"
        console.log('ID from route: ', doctor_id)

    </script>
@endpush
