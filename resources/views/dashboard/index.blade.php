@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-deck mt-3 text-light text-center font-weight-bold">

                <div class="card bg-primary">
                    <div class="card-header">Total Doctor</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            Work
                        </h1>
                    </div>
                </div>

                <div class="card bg-success">
                    <div class="card-header">Total Patient</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            Work
                        </h1>
                    </div>
                </div>

                <div class="card bg-danger">
                    <div class="card-header">Today Add Patient</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            Work
                        </h1>
                    </div>
                </div>

                <div class="card bg-info">
                    <div class="card-header">Appointment Patient</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            Work
                        </h1>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card-deck mt-3 text-light text-center font-weight-bold">

                <div class="card bg-primary">
                    <div class="card-header">Today Payed</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            Work
                        </h1>
                    </div>
                </div>

                <div class="card bg-success">
                    <div class="card-header">Total Due</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            Work
                        </h1>
                    </div>
                </div>

                <div class="card bg-warning">
                    <div class="card-header">Human Resource</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            Work
                        </h1>
                    </div>
                </div>

                <div class="card bg-danger">
                    <div class="card-header">Not Work</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            Work
                        </h1>
                    </div>
                </div>


            </div>
        </div>
{{--        --}}{{--    $user = auth()->user;--}}


{{--            User: {{ Auth::user() }}--}}
{{--        <div class="col-md-12 pt-5 text-center">--}}
{{--            Has role: {{ hasRole('ambulance.index') }}--}}
{{--            <br>--}}
{{--            Has model access: {{ checkOrganizationModuleAccess('Test') }}--}}
{{--            <br>--}}
{{--            Module Id: {{ getModuleIdByName('Doctor') }}--}}
{{--            <br>--}}
{{--            Modules: {{ getOrganizationModules() }}--}}
{{--            <br>--}}
{{--            Auth: {{ Auth::user()}}--}}
{{--            <br>--}}
{{--            Name: {{ Auth::user()->full_name}}--}}
{{--            <br>--}}
{{--            Role: {{ Auth::user()->getRoleNames()  }}--}}
{{--            <br>--}}
{{--            Role Name: {{ Auth::user()->roles }}--}}
{{--            <br>--}}
{{--            Organization:{{ Auth::user()->organization->name }}--}}
{{--            Organization:{{ Auth::user()->organization }}--}}
{{--        </div>--}}
    </div>
@endsection
