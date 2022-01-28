<div class="admin-nav p-0">
    <h4 class="text-light text-center p-2">Admin Panel</h4>

    <div class="list-group list-group-flush nav-side-menu">

        <div class="menu-list">
            {{--            @dd(Request::is('dashboard'))--}}
            <ul id="menu-content" class="menu-content collapse out">

                <a href={{route('dashboard.index')}}>
                    <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"
                                                                                  style="width: 20px"></i> Dashboard
                    </li>
                </a>

                @if(checkUserRole('department.index'))
                    <a href={{route('department.index')}}>
                        <li class="{{ Request::is('department') ? 'active' : '' }}"><i class="fas fa-sitemap" style="width: 20px"></i>
                            Departments
                        </li>
                    </a>

                @endif


                <a href="#">
                    <li data-toggle="collapse" data-target="#doctor" class="">
                        <i class="fas fa-user-md" style="width: 20px"></i> Doctors <span class="arrow"></span></li>
                </a>

                <ul class="sub-menu collapse {{ Request::is('doctor*') ? 'show' : '' }}" id="doctor">
                    @if(checkUserRole('doctor.create'))
                        <a href={{route('doctor.create')}}>
                            <li class="{{ Request::is('doctor/create') ? 'active' : '' }}">Create Doctors</li>
                        </a>
                    @endif

                    @if(checkUserRole('doctor.index'))
                        <a href={{route('doctor.index')}}>
                            <li class="{{ Request::is('doctor') ? 'active' : '' }}">Doctors List</li>
                        </a>
                    @endif

                    @if(checkUserRole('doctor.holidays.index'))
                        <a href={{route('doctor.holiday.index')}}>
                            <li class="{{ Request::is('doctor/holiday') ? 'active' : '' }}">Doctor Holiday</li>
                        </a>
                    @endif

                    @if(checkUserRole('doctor.allDoctorSchedule.index'))
                        <a href={{route('doctor.all-doctors.schedule.index')}}>
                            <li class="{{ Request::is('doctor/all-doctors/schedule') ? 'active' : '' }}">All Schedule
                            </li>
                        </a>
                    @endif

                </ul>


                @if(checkUserRole('patient.index'))
                    <a href="#"><li data-toggle="collapse" data-target="#patients" class="collapsed">
                        <i class="fas fa-stethoscope" style="width: 20px"></i> Patients <span class="arrow"></span></li></a>


                    <ul class="sub-menu collapse {{ Request::is('patient','patient/create','patient/*/edit','patient/*/patient-show','patient/*/history','patient/currentPatient','patient/appointment','patient/appointment/*') ? 'show' : '' }}"
                        id="patients">

                        <a href={{route('patient.index')}}><li class="{{ Request::is('patient') ? 'active' : '' }}">
                             All Patients</li></a>

                        <a href={{route('patient.currentPatient')}}><li class="{{ Request::is('patient/create','patient/*/edit','patient/*/patient-show','patient/*/history','patient/currentPatient') ? 'active' : '' }}">
                             Indoor Patients</li></a>

                        <a href={{route('patient.appointment.index')}}><li class="{{ Request::is('patient/appointment','patient/appointment/*') ? 'active' : '' }}">
                            Outdoor Patients</li></a>
                    </ul>
                @endif

                @if(checkUserRole('sidenav.staff'))
                    <a href="#"><li data-toggle="collapse" data-target="#human-resources" class="collapsed">
                        <i class="fas fa-users-cog" style="width: 20px"></i> Human Resources <span class="arrow"></span></li></a>

                @endif
                <ul class="sub-menu collapse {{ Request::is('staff*') ? 'show' : '' }}" id="human-resources">
                    @if(checkUserRole('staff.create'))
                        <a href={{route('staff.create')}}>
                            <li class="{{ Request::is('staff/create') ? 'active' : '' }}">Add Staff</li>
                        </a>
                    @endif

                    @if(checkUserRole('staff.index'))
                            <a href={{route('staff.index')}}><li class="{{ Request::is('staff') ? 'active' : '' }}">All
                                Staff</li></a>
                    @endif

                    @if(checkUserRole('staff.holiday.index'))
                            <a
                               href={{route('staff.holiday.index')}}><li class="{{ Request::is('staff/holiday') ? 'active' : '' }}">Holiday</li></a>
                    @endif
                </ul>

                @if(checkUserRole('sidenav.bed'))
                    <!-- <a class="d-flex" href="#"><li data-toggle="collapse" data-target="#bed-manager" class="collapsed">
                        <i class="fas fa-procedures" style="width: 20px"></i> Bed Manager <span class="arrow"></span></li></a> -->

                @endif

                <ul class="sub-menu collapse {{ Request::is('bed*') ? 'show' : '' }}" id="bed-manager">
                    @if(checkUserRole('bed.assign.index'))
                        <a
                           href={{route('bed.assign.index')}}><li class="{{ Request::is('bed/assign') ? 'active' : '' }}">Bed Assign</li></a>
                    @endif

                    @if(checkUserRole('bed.list.index'))
                            <a href={{route('bed.list.index')}}><li class="{{ Request::is('bed/list') ? 'active' : '' }}">Bed
                                List</li></a>
                    @endif

                    @if(checkUserRole('bed.type.index'))
                            <a href={{route('bed.type.index')}}><li class="{{ Request::is('bed/type') ? 'active' : '' }}">Bed
                                Type</li></a>
                    @endif
                </ul>

                @if(checkUserRole('sidenav.accounts'))
                    <a href="#"><li data-toggle="collapse" data-target="#billing" class="collapsed">
                        <i class="fas fa-money-bill" style="width: 20px"></i> Accounts <span class="arrow"></span></li></a>

                @endif

                <ul class="sub-menu collapse {{ Request::is('salary','salary/*','bill','bill/*','patient/billingList','patient/*/billing/show','patient/billingList/old','patient/billingList/old/*/show') ? 'show' : '' }}"
                    id="billing">
                    @if(checkUserRole('salary.index'))
                        <a href={{route('salary.index')}}><li class="{{ Request::is('salary','salary/*') ? 'active' : '' }}">Pay
                                Salary</li></a>
                    @endif

                    @if(checkUserRole('bill.index'))
                            <a href={{route('bill.index')}}><li class="{{ Request::is('bill','bill/*') ? 'active' : '' }}">Organization
                                Billing</li></a>
                    @endif
                    <a href={{route('earning.index')}}><li class="{{ Request::is('earning','earning/*') ? 'active' : '' }}">Daily Earning</li></a>
                    {{--                            @if(checkUserRole('patient.payment.index'))--}}
                        <a href={{route('patient.billingList.index')}}><li class="{{ Request::is('patient/billingList','patient/*/billing/show') ? 'active' : '' }}">Patient Billing</li></a>
                        <a href={{route('patient.billingList.old')}}><li class="{{ Request::is('patient/billingList/old','patient/billingList/old/*/show') ? 'active' : '' }}">Old Billings</li></a>
                    {{--                            @endif--}}
                </ul>


                {{--                @if(checkUserRole('department.index'))--}}
                <a href={{route('lab.index')}}><li class="{{ Request::is('lab') ? 'active' : '' }}">
                    <i class="fas fa-building" style="width: 20px"></i> Labs</li></a>

                {{--                @endif--}}


                {{--                        @if(checkUserRole('sidenav.test'))--}}
                <a href="#"><li data-toggle="collapse" data-target="#test" class="collapsed">
                    <i class="fas fa-vials" style="width: 20px"></i> Diagnostic Tests <span class="arrow"></span></li></a>

                {{--                        @endif--}}
                <ul class="sub-menu collapse {{ Request::is('test*') ? 'show' : '' }}" id="test">
                    {{--                            @if(checkUserRole('test.index'))--}}
                    <a href={{route('test.category.index')}}><li class="{{ Request::is('test/category') ? 'active' : '' }}">Test Categories</li></a>
                    {{--                            @endif--}}
                    {{--                            @if(checkUserRole('test.index'))--}}
                    <a href={{route('test.item.index')}}><li class="{{ Request::is('test/item') ? 'active' : '' }}">Test
                            Items</li></a>

                    <a href={{route('test.result.category.index')}}><li class="{{ Request::is('test/result/category') ? 'active' : '' }}">Test Result Category</li></a>

                    <a href={{route('test.result.item.index')}}><li class="{{ Request::is('test/result/item') ? 'active' : '' }}">Test Result Item</li></a>
                    {{--                            @endif--}}

                    {{--                            @if(checkUserRole('test.toPatient.index'))--}}
                    <a href={{route('test.patient.index')}}><li class="{{ Request::is('test/patient') ? 'active' : '' }}">Patient Tests</li></a>
                    {{--                            @endif--}}
                    {{--                            --}}{{--                            <li><a href={{route('test.patient.edit', $testItems->id)}}>Lab</a></li>--}}
                </ul>

                @if(checkUserRole('healthCard.index'))
                    <a href={{route('health-card.index')}}><li class="{{ Request::is('health-card') ? 'active' : '' }}">
                        <i class="fas fa-h-square" style="width: 20px"></i> Health Card</li></a>
                @endif
                @if(checkUserRole('ambulance.index'))
                    <!-- <a class="d-flex" href={{route('ambulance.index')}}><li class="{{ Request::is('ambulance') ? 'active' : '' }}">
                        <i class="fas fa-ambulance" style="width: 20px"></i> Ambulance</li></a> -->

                @endif

                @if(checkUserRole('sidenav.blood'))
                    <!-- <a class="d-flex" href="#"><li data-toggle="collapse" data-target="#blood-bank" class="collapsed">
                        <i class="fas fa-laptop-medical" style="width: 20px"></i> Blood Bank <span class="arrow"></span></li></a> -->

                @endif
                <ul class="sub-menu collapse {{ Request::is('blood') ? 'show' : '' }}" id="blood-bank">
                    @if(checkUserRole('blood.input.index'))
                        <a href={{route('blood.input.index')}}><li class="{{ Request::is('blood/input') ? 'active' : '' }}">Input Blood</li></a>
                    @endif

                    @if(checkUserRole('blood.output.index'))
                            <a href={{route('blood.output.index')}}><li class="{{ Request::is('blood/output') ? 'active' : '' }}">Output Blood</li></a>
                    @endif

                    @if(checkUserRole('blood.donor.index'))
                            <a href={{route('blood.donor.index')}}><li class="{{ Request::is('blood/donor') ? 'active' : '' }}">Blood Donor</li></a>
                    @endif
                </ul>

                @if(checkUserRole('sidenav.activity'))
                    <!-- <a href="#"><li data-toggle="collapse" data-target="#organization-activities" class="collapsed"> -->
                            <!-- <i class="fas fa-bezier-curve" style="width: 20px"></i> Organization Activity <span
                                class="arrow"></span></li></a> -->
                @endif
                <ul class="sub-menu collapse {{ Request::is('birth','death') ? 'show' : '' }}"
                    id="organization-activities">
                    @if(checkUserRole('birth.index'))
                        <a href={{route('birth.index')}}><li class="{{ Request::is('birth') ? 'active' : '' }}">Birth
                                Record</li></a>
                    @endif

                    @if(checkUserRole('death.index'))
                            <a href={{route('death.index')}}><li class="{{ Request::is('death') ? 'active' : '' }}">Death
                                Record</li></a>
                    @endif
                </ul>

                @if(checkUserRole('sms.index'))
                    <a href={{route('sms.index')}}><li class="{{ Request::is('sms') ? 'active' : '' }}">
                        <i class="fas fa-sms" style="width:20px"></i> SMS</li></a>

                @endif
                @if(checkUserRole('email.index'))
                    <a href={{route('email.index')}}><li class="{{ Request::is('email') ? 'active' : '' }}">
                        <i class="fas fa-envelope-open-text" style="width:20px"></i> Mail</li></a>

                @endif

                @if(checkUserRole('settings.index'))
                    <a href="#"><li data-toggle="collapse" data-target="#settings" class="collapsed">
                            <i class="fas fa-cogs" style="width: 20px"></i> Settings <span
                                class="arrow"></span></li></a>

                @endif
                <ul class="sub-menu collapse {{ Request::is('setting*') ? 'show' : '' }}" id="settings">
                    @if(checkUserRole('settings.index'))
                        <a href={{route('setting.index')}}><li class="{{ Request::is('setting') ? 'active' : '' }}">Organization
                                Settings</li></a>
                    @endif
                </ul>

                @if(checkUserRole('notice.index'))
                    <a href={{route('notice.index')}}><li class="{{ Request::is('notice') ? 'active' : '' }}">
                        <i class="fas fa-notes-medical"></i> Notice Board</li></a>

                @endif

                @if(checkUserRole('profile.index'))
                    <a href={{route('profile.index')}}><li class="{{ Request::is('profile') ? 'active' : '' }}">
                        <i class="fas fa-address-card"></i>
                            Profile</li></a>

                @endif
            </ul>
        </div>
    </div>
</div>
