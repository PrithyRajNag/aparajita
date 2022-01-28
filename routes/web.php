<?php

use App\Mail\TestMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Company')->prefix('company')->name('company.')->group(function () {
    //Organization
    Route::prefix('organization')->name('organization.')->group(function () {
        Route::get('/', 'OrganizationController@index')->name('index');
        Route::get('/create', 'OrganizationController@create')->name('create');
        Route::post('/store', 'OrganizationController@store')->name('store');
        Route::get('/{id}/show', 'OrganizationController@show')->name('show');
        Route::get('/{id}/edit', 'OrganizationController@edit')->name('edit');
        Route::put('/{id}/update', 'OrganizationController@update')->name('update');
        Route::delete('/{id}/destroy', 'OrganizationController@destroy')->name('destroy');
    });

    //Employee
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('/', 'CompanyEmployeeController@index')->name('index');
        Route::get('/create', 'CompanyEmployeeController@create')->name('create');
        Route::post('/store', 'CompanyEmployeeController@store')->name('store');
        Route::get('/{id}/show', 'CompanyEmployeeController@show')->name('show');
        Route::get('/{id}/edit', 'CompanyEmployeeController@edit')->name('edit');
        Route::put('/{id}/update', 'CompanyEmployeeController@update')->name('update');
        Route::delete('/{id}/destroy', 'CompanyEmployeeController@destroy')->name('destroy');
    });
    Route::prefix('sms')->name('sms.')->group(function () {
        Route::get('/', 'OrganizationSmsController@index')->name('index');
        Route::get('/create', 'OrganizationSmsController@create')->name('create');
        Route::post('/store', 'OrganizationSmsController@store')->name('store');
        Route::get('/{id}/show', 'OrganizationSmsController@show')->name('show');
        Route::get('/{id}/edit', 'OrganizationSmsController@edit')->name('edit');
        Route::put('/{id}/update', 'OrganizationSmsController@update')->name('update');
        Route::delete('/{id}/destroy', 'OrganizationSmsController@destroy')->name('destroy');
    });

    //Dashboard
    Route::get('/dashboard', 'CompanyDashboardController@index')->name('dashboard.index');

    //Module
    Route::prefix('module')->name('module.')->group(function () {
        Route::get('/', 'CompanyModuleController@index')->name('index');
        Route::post('/store', 'CompanyModuleController@store')->name('store');
        Route::get('/{id}/show', 'CompanyModuleController@show')->name('show');
        Route::put('/{id}/update', 'CompanyModuleController@update')->name('update');
        Route::delete('/{id}/destroy', 'CompanyModuleController@destroy')->name('destroy');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'CompanyProfileController@index')->name('index');
        Route::put('/{profile}/update', 'CompanyProfileController@update')->name('update');
        Route::put('/pass/{profile}/passUpdate', 'CompanyProfileController@passUpdate')->name('passUpdate');
    });

});

Route::get('/', 'Auth\LoginController@showLoginForm')->name('customer-login');

Route::post('/forget-password', 'Auth\ForgotPasswordController@submitForgetPasswordForm')->name('forget.password.post');
Route::post('/reset-password', 'Auth\ForgotPasswordController@submitResetPasswordForm')->name('reset.password.post');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

    //doctor
    Route::namespace('Doctor')->prefix('doctor')->name('doctor.')->group(function () {
        //Doctor Appointment

//        Route::prefix('appointment')->name('appointment.')->group(function () {
//            Route::get('/', 'DoctorAppointmentController@index')->name('index');
//            Route::post('/store', 'DoctorAppointmentController@store')->name('store');
//            Route::get('/{appointment}', 'DoctorAppointmentController@show')->name('show');
//            Route::put('/{appointment}/update', 'DoctorAppointmentController@update')->name('update');
//            Route::delete('/{appointment}/destroy', 'DoctorAppointmentController@destroy')->name('destroy');
//        });


        //Doctor holiday
        Route::prefix('holiday')->name('holiday.')->group(function () {
            Route::get('/', 'DoctorHolidayController@index')->middleware('role:doctor.holidays.index')->name('index');
            Route::post('/store', 'DoctorHolidayController@store')->middleware('role:doctor.holidays.store')->name('store');
            Route::get('/{holiday}', 'DoctorHolidayController@show')->middleware('role:doctor.holidays.show')->name('show');
            Route::put('/{holiday}/update', 'DoctorHolidayController@update')->middleware('role:doctor.holidays.update')->name('update');
            Route::delete('/{holiday}/destroy', 'DoctorHolidayController@destroy')->middleware('role:doctor.holidays.destroy')->name('destroy');
        });


        Route::get('/document/{slug}/download', 'DoctorHistoryController@download')->name('document.download');
        //Doctor History
        Route::prefix('{doctor_id}/history')->name('history.')->group(function () {
            Route::get('/', 'DoctorHistoryController@index')->middleware('role:doctor.history.index')->name('index');
            Route::post('/store', 'DoctorHistoryController@store')->middleware('role:doctor.history.store')->name('store');
            Route::get('/{history}/show', 'DoctorHistoryController@show')->middleware('role:doctor.history.show')->name('show');
            Route::put('/{history}/update', 'DoctorHistoryController@update')->middleware('role:doctor.history.update')->name('update');
            Route::delete('/{history}/destroy', 'DoctorHistoryController@destroy')->middleware('role:doctor.history.destroy')->name('destroy');


            Route::get('/document', 'DoctorHistoryController@document')->name('document');
            Route::get('/upload', 'DoctorHistoryController@upload')->name('upload');
            Route::post('/save', 'DoctorHistoryController@save')->name('save');
        });

        //All Doctor Schedule
        Route::prefix('all-doctors/schedule')->name('all-doctors.schedule.')->group(function () {
            Route::get('/', 'AllDoctorsScheduleController@index')->middleware('role:doctor.allDoctorSchedule.index')->name('index');
            Route::get('/create', 'AllDoctorsScheduleController@create')->middleware('role:doctor.allDoctorSchedule.create')->name('create');
            Route::post('/store', 'AllDoctorsScheduleController@store')->middleware('role:doctor.allDoctorSchedule.store')->name('store');
            Route::get('/{id}/show', 'AllDoctorsScheduleController@show')->middleware('role:doctor.allDoctorSchedule.show')->name('show');
            Route::get('/{id}/edit', 'AllDoctorsScheduleController@edit')->middleware('role:doctor.allDoctorSchedule.edit')->name('edit');
            Route::put('/{id}/update', 'AllDoctorsScheduleController@update')->middleware('role:doctor.allDoctorSchedule.update')->name('update');
            Route::delete('/{id}/destroy', 'AllDoctorsScheduleController@destroy')->middleware('role:doctor.allDoctorSchedule.destroy')->name('destroy');

        });

        //doctor
        Route::get('/', 'DoctorController@index')->middleware('role:doctor.index')->name('index');
        Route::get('/create', 'DoctorController@create')->middleware('role:doctor.index')->name('create');
        Route::post('/store', 'DoctorController@store')->middleware('role:doctor.store')->name('store');
        Route::get('/{doctor}/show', 'DoctorController@show')->middleware('role:doctor.show')->name('show');
        Route::get('/{doctor}/edit', 'DoctorController@edit')->middleware('role:doctor.edit')->name('edit');
        Route::put('/{doctor}/update', 'DoctorController@update')->middleware('role:doctor.update')->name('update');
        Route::delete('/{doctor}/destroy', 'DoctorController@destroy')->middleware('role:doctor.destroy')->name('destroy');

    });


    //patient
    Route::namespace('Patient')->prefix('patient')->name('patient.')->group(function () {
        //patient Appointment
        Route::prefix('appointment')->name('appointment.')->group(function () {
            Route::get('/', 'PatientAppointmentController@index')->middleware('role:patient.appointment.index')->name('index');
            Route::get('/create', 'PatientAppointmentController@create')->middleware('role:patient.appointment.create')->name('create');
            Route::post('/store', 'PatientAppointmentController@store')->middleware('role:patient.appointment.store')->name('store');
            Route::get('/{id}/show', 'PatientAppointmentController@show')->middleware('role:patient.appointment.show')->name('show');
            Route::get('/{id}/edit', 'PatientAppointmentController@edit')->middleware('role:patient.appointment.edit')->name('edit');
            Route::put('/{id}/update', 'PatientAppointmentController@update')->middleware('role:patient.appointment.update')->name('update');
            Route::delete('/{id}/destroy', 'PatientAppointmentController@destroy')->middleware('role:patient.appointment.destroy')->name('destroy');

            Route::post('/slots', 'PatientAppointmentController@getStots')->name('slots');
        });

//        //Patient Payment
//        Route::prefix('payment')->name('payment.')->group(function () {
//            Route::get('/', 'PatientPaymentController@index')->middleware('role:patient.payment.index')->name('index');
//            Route::post('/store', 'PatientPaymentController@store')->middleware('role:patient.payment.store')->name('store');
//            Route::get('/{payment}/show', 'PatientPaymentController@show')->middleware('role:patient.payment.show')->name('show');
//            Route::put('/{payment}/update', 'PatientPaymentController@update')->middleware('role:patient.payment.update')->name('update');
//            Route::delete('/{payment}/destroy', 'PatientPaymentController@destroy')->middleware('role:patient.payment.destroy')->name('destroy');
//
//
//            Route::get('/{payment}/pay', 'PatientPaymentController@pay')->middleware('role:patient.payment.pay')->name('pay');
//            Route::put('/{payment}/paid', 'PatientPaymentController@paid')->middleware('role:patient.payment.paid')->name('paid');
//        });

        //Patient History
        Route::prefix('{patient_id}/history')->name('history.')->group(function () {
            Route::get('/', 'PatientHistoryController@index')->middleware('role:patient.history.index')->name('index');
            Route::post('/store', 'PatientHistoryController@store')->middleware('role:patient.history.store')->name('store');
            Route::get('/{history}/show', 'PatientHistoryController@show')->middleware('role:patient.history.show')->name('show');
            Route::put('/{history}/update', 'PatientHistoryController@update')->middleware('role:patient.history.update')->name('update');
            Route::delete('/{history}/destroy', 'PatientHistoryController@destroy')->middleware('role:patient.history.destroy')->name('destroy');
        });

        //Patient Billing
//        Route::prefix('{patient_id}/billing')->name('billing.')->group(function () {
//            Route::get('/', 'PatientBillingController@index')->name('index');
//            Route::post('/store', 'PatientBillingController@store')->name('store');
//            Route::get('/{billing}/show', 'PatientBillingController@show')->name('show');
//            Route::put('/{billing}/update', 'PatientBillingController@update')->name('update');
//            Route::delete('/{billing}/destroy', 'PatientBillingController@destroy')->name('destroy');
//        });
        Route::prefix('billingList')->name('billingList.')->group(function () {
            Route::get('/', 'PatientBillingController@index')->name('index');
            Route::get('/old', 'PatientBillingController@old')->name('old');
            Route::get('/old/{id}/show', 'PatientBillingController@oldDetails')->name('old.show');
            Route::get('/old/{id}/pdf', 'PatientBillingController@oldPdf')->name('old.pdf');
        });
        Route::prefix('{patient_id}/billing')->name('billing.')->group(function () {
//            Route::get('/', 'PatientBillingController@index')->name('index');
            Route::post('/store', 'PatientBillingController@store')->name('store');
            Route::get('/show', 'PatientBillingController@show')->name('show');
            Route::put('/update', 'PatientBillingController@update')->name('update');
            Route::delete('/destroy', 'PatientBillingController@destroy')->name('destroy');
            Route::get('/pdf', 'PatientBillingController@pdf')->name('pdf');
            Route::get('/resolved', 'PatientBillingController@resolved')->name('resolved');
        });
        //Patient Report
//        Route::prefix('report')->name('report.')->group(function () {
//            Route::get('/', 'PatientReportController@index')->name('index');
//            Route::post('/store', 'PatientReportController@store')->name('store');
//            Route::get('/{report}', 'PatientReportController@show')->name('show');
//            Route::put('/{report}/update', 'PatientReportController@update')->name('update');
//            Route::delete('/{report}/destroy', 'PatientReportController@destroy')->name('destroy');
//        });

        //Patient
        Route::get('/', 'PatientController@index')->middleware('role:patient.index')->name('index');
        Route::get('/currentPatient', 'PatientController@currentPatient')->middleware('role:patient.index')->name('currentPatient');
        Route::get('/create', 'PatientController@create')->middleware('role:patient.create')->name('create');
        Route::post('/store', 'PatientController@store')->middleware('role:patient.store')->name('store');
        Route::get('/{id}/show', 'PatientController@show')->middleware('role:patient.show')->name('show');
        Route::get('/{id}/patient-show', 'PatientController@show')->middleware('role:patient.show')->name('patient-show');
        Route::get('/{id}/edit', 'PatientController@edit')->middleware('role:patient.edit')->name('edit');
        Route::put('/{id}/update', 'PatientController@update')->middleware('role:patient.update')->name('update');
        Route::delete('/{id}/destroy', 'PatientController@destroy')->middleware('role:patient.destroy')->name('destroy');
    });


    //Bed
    Route::namespace('Bed')->prefix('bed')->name('bed.')->group(function () {
        //Bed Assign
        Route::prefix('assign')->name('assign.')->group(function () {
            Route::get('/', 'BedAssignController@index')->middleware('role:bed.assign.index')->name('index');
            Route::post('/store', 'BedAssignController@store')->middleware('role:bed.assign.store')->name('store');
            Route::get('/{assign}', 'BedAssignController@show')->middleware('role:bed.assign.show')->name('show');
//            Route::put('/{assign}/update', 'BedAssignController@update')->middleware('role:bed.assign.update')->name('update');
            Route::any('/{assign}/update', 'BedAssignController@update')->middleware('role:bed.assign.update')->name('update');
            Route::delete('/{assign}/destroy', 'BedAssignController@destroy')->middleware('role:bed.assign.destroy')->name('destroy');

            Route::get('/{bed_type_id}/beds', 'BedAssignController@beds')->name('beds');
        });
        //Bed List
        Route::prefix('list')->name('list.')->group(function () {
            Route::get('/', 'BedListController@index')->middleware('role:bed.list.index')->name('index');
            Route::post('/store', 'BedListController@store')->middleware('role:bed.list.store')->name('store');
            Route::get('/{id}', 'BedListController@show')->middleware('role:bed.list.show')->name('show');
            Route::put('/{list}/update', 'BedListController@update')->middleware('role:bed.list.update')->name('update');
            Route::delete('/{list}/destroy', 'BedListController@destroy')->middleware('role:bed.list.destroy')->name('destroy');
        });
        //Bed Type
        Route::prefix('type')->name('type.')->group(function () {
            Route::get('/', 'BedTypeController@index')->middleware('role:bed.type.index')->name('index');
            Route::post('/store', 'BedTypeController@store')->middleware('role:bed.type.store')->name('store');
            Route::get('/{type}', 'BedTypeController@show')->middleware('role:bed.type.show')->name('show');
            Route::put('/{type}/update', 'BedTypeController@update')->middleware('role:bed.type.update')->name('update');
            Route::delete('/{type}/destroy', 'BedTypeController@destroy')->middleware('role:bed.type.destroy')->name('destroy');
        });


    });


    //blood
    Route::namespace('Blood')->prefix('blood')->name('blood.')->group(function () {

        Route::prefix('donor')->name('donor.')->group(function () {
            Route::get('/', 'BloodDonorController@index')->middleware('role:blood.donor.index')->name('index');
            Route::post('/store', 'BloodDonorController@store')->middleware('role:blood.donor.store')->name('store');
            Route::get('/{donor}', 'BloodDonorController@show')->middleware('role:blood.donor.show')->name('show');
            Route::put('/{donor}/update', 'BloodDonorController@update')->middleware('role:blood.donor.update')->name('update');
            Route::delete('/{donor}/destroy', 'BloodDonorController@destroy')->middleware('role:blood.donor.destroy')->name('destroy');
        });

        Route::prefix('input')->name('input.')->group(function () {
            Route::get('/', 'BloodInputController@index')->middleware('role:blood.input.index')->name('index');
            Route::post('/store', 'BloodInputController@store')->middleware('role:blood.input.store')->name('store');
            Route::get('/{input}', 'BloodInputController@show')->middleware('role:blood.input.show')->name('show');
            Route::put('/{input}/update', 'BloodInputController@update')->middleware('role:blood.input.update')->name('update');
            Route::delete('/{input}/destroy', 'BloodInputController@destroy')->middleware('role:blood.input.destroy')->name('destroy');
        });

        Route::prefix('output')->name('output.')->group(function () {
            Route::get('/', 'BloodOutputController@index')->middleware('role:blood.output.index')->name('index');
            Route::post('/store', 'BloodOutputController@store')->middleware('role:blood.output.store')->name('store');
            Route::get('/{output}', 'BloodOutputController@show')->middleware('role:blood.output.show')->name('show');
            Route::put('/{output}/update', 'BloodOutputController@update')->middleware('role:blood.output.update')->name('update');
            Route::delete('/{output}/destroy', 'BloodOutputController@destroy')->middleware('role:blood.output.destroy')->name('destroy');

            Route::get('/{blood_group_id}/bags', 'BloodOutputController@bloodBags')->name('bloodBags');
        });


    });


    Route::namespace('Staff')->prefix('staff')->name('staff.')->group(function () {

        //Staff holidays
        Route::prefix('holiday')->name('holiday.')->group(function () {
            Route::get('/', 'StaffHolidaysController@index')->middleware('role:staff.holiday.index')->name('index');
            Route::post('/store', 'StaffHolidaysController@store')->middleware('role:staff.holiday.store')->name('store');
            Route::get('/{holiday}', 'StaffHolidaysController@show')->middleware('role:staff.holiday.show')->name('show');
            Route::put('/{holiday}/update', 'StaffHolidaysController@update')->middleware('role:staff.holiday.update')->name('update');
            Route::delete('/{holiday}/destroy', 'StaffHolidaysController@destroy')->middleware('role:staff.holiday.destroy')->name('destroy');
        });


        Route::get('/', 'StaffController@index')->middleware('role:staff.index')->name('index');
        Route::get('/create', 'StaffController@create')->middleware('role:staff.create')->name('create');
        Route::post('/store', 'StaffController@store')->middleware('role:staff.store')->name('store');
        Route::get('/{staff}/show', 'StaffController@show')->middleware('role:staff.show')->name('show');
        Route::get('/{staff}/edit', 'StaffController@edit')->middleware('role:staff.edit')->name('edit');
        Route::put('/{staff}/update', 'StaffController@update')->middleware('role:staff.update')->name('update');
        Route::delete('/{staff}/destroy', 'StaffController@destroy')->middleware('role:staff.destroy')->name('destroy');

//        Route::get('/accountant', 'StaffController@accountant')->name('accountant');
//        Route::get('/nurse', 'StaffController@nurse')->name('nurse');
    });

//    Route::get('/staff', 'Staff\StaffController@index')->name('staff.index');

//    Route::get('/all-staff', 'Staff\AllStaffController@index')->name('all_staff.index');


    //Ambulance

    Route::prefix('ambulance')->name('ambulance.')->group(function () {
        Route::get('/', 'AmbulanceController@index')->middleware('role:ambulance.index')->name('index');
        Route::post('/store', 'AmbulanceController@store')->middleware('role:ambulance.store')->name('store');
        Route::get('/{ambulance}', 'AmbulanceController@show')->middleware('role:ambulance.show')->name('show');
        Route::put('/{ambulance}/update', 'AmbulanceController@update')->middleware('role:ambulance.update')->name('update');
        Route::delete('/{ambulance}/destroy', 'AmbulanceController@destroy')->middleware('role:ambulance.destroy')->name('destroy');
    });


//    Route::get('/ambulance', 'AmbulanceController@index')->name('ambulance.index');


    //Birth
    Route::prefix('birth')->name('birth.')->group(function () {
        Route::get('/', 'BirthController@index')->middleware('role:birth.index')->name('index');
        Route::post('/store', 'BirthController@store')->middleware('role:birth.store')->name('store');
        Route::get('/{birth}', 'BirthController@show')->middleware('role:birth.show')->name('show');
        Route::put('/{birth}/update', 'BirthController@update')->middleware('role:birth.update')->name('update');
        Route::delete('/{birth}/destroy', 'BirthController@destroy')->middleware('role:birth.destroy')->name('destroy');
        Route::get('/{birth}/pdf', 'BirthController@pdf')->name('pdf');
    });

//    Route::get('/birth', 'BirthController@index')->name('birth.index');


    //Death
    Route::prefix('death')->name('death.')->group(function () {
        Route::get('/', 'DeathController@index')->middleware('role:death.index')->name('index');
        Route::post('/store', 'DeathController@store')->middleware('role:death.store')->name('store');
        Route::get('/{death}', 'DeathController@show')->middleware('role:death.show')->name('show');
        Route::put('/{death}/update', 'DeathController@update')->middleware('role:death.update')->name('update');
        Route::delete('/{death}/destroy', 'DeathController@destroy')->middleware('role:death.destroy')->name('destroy');
        Route::get('/{death}/pdf', 'DeathController@pdf')->name('pdf');
    });

//    Route::get('/death', 'DeathController@index')->name('death.index');

    //Department
    Route::prefix('department')->name('department.')->group(function () {
        Route::get('/', 'DepartmentController@index')->middleware('role:department.index')->name('index');
        Route::post('/store', 'DepartmentController@store')->middleware('role:department.store')->name('store');
        Route::get('/{department}', 'DepartmentController@show')->middleware('role:department.show')->name('show');
        Route::put('/{department}/update', 'DepartmentController@update')->middleware('role:department.update')->name('update');
        Route::delete('/{department}/destroy', 'DepartmentController@destroy')->middleware('role:department.destroy')->name('destroy');
    });

//    Route::get('/department', 'DepartmentController@index')->name('department.index');

    //Email
    Route::prefix('email')->name('email.')->group(function () {


//        Route::get('/test', 'EmailController@test');

        Route::get('/', 'EmailController@index')->middleware('role:email.index')->name('index');
        Route::post('/send', 'EmailController@send')->name('send');
//        Route::get('/{email}', 'EmailController@show')->name('show');
//        Route::put('/{email}/update', 'EmailController@update')->name('update');
        Route::delete('/{email}/destroy', 'EmailController@destroy')->name('destroy');
    });
//    Route::get('/email', 'EmailController@index')->middleware('role:email.index')->name('email.index');


    //HealthCard
    Route::prefix('health-card')->name('health-card.')->group(function () {
        Route::get('/', 'HealthCardController@index')->middleware('role:healthCard.index')->name('index');
        Route::post('/store', 'HealthCardController@store')->middleware('role:healthCard.store')->name('store');
        Route::get('/{id}/show', 'HealthCardController@show')->middleware('role:healthCard.show')->name('show');
        Route::put('/{id}/update', 'HealthCardController@update')->middleware('role:healthCard.update')->name('update');
        Route::delete('/{id}/destroy', 'HealthCardController@destroy')->middleware('role:healthCard.destroy')->name('destroy');
    });

//    Route::get('/health-card', 'HealthCardController@index')->name('health_card.index');

    //Notice
    Route::prefix('notice')->name('notice.')->group(function () {
        Route::get('/', 'NoticeController@index')->middleware('role:notice.index')->name('index');
        Route::post('/store', 'NoticeController@store')->middleware('role:notice.store')->name('store');
        Route::get('/{notice}/show', 'NoticeController@show')->middleware('role:notice.show')->name('show');
        Route::put('/{notice}/update', 'NoticeController@update')->middleware('role:notice.update')->name('update');
        Route::delete('/{notice}/destroy', 'NoticeController@destroy')->middleware('role:notice.destroy')->name('destroy');
    });

//    Route::get('/notice', 'NoticeController@index')->name('notice.index');

    //Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'ProfileController@index')->middleware('role:profile.index')->name('index');
//        Route::post('/store', 'ProfileController@store')->name('store');
//        Route::get('/{profile}', 'ProfileController@show')->name('show');
//        Route::get('/{profile}/edit', 'ProfileController@edit')->name('edit');
        Route::put('/{profile}/update', 'ProfileController@update')->middleware('role:profile.update')->name('update');
        Route::put('/pass/{profile}/passUpdate', 'ProfileController@passUpdate')->middleware('role:profile.passUpdate')->name('passUpdate');
//        Route::delete('/{profile}/destroy', 'ProfileController@destroy')->name('destroy');
    });

    //Setting
    Route::prefix('setting')->name('setting.')->group(function () {
//        Route::get('/', 'SettingController@index')->name('index');
//        Route::post('/store', 'SettingController@store')->name('store');
//        Route::get('/{setting}', 'SettingController@show')->name('show');
//        Route::put('/{setting}/update', 'SettingController@update')->name('update');
//        Route::delete('/{setting}/destroy', 'SettingController@destroy')->name('destroy');

        Route::get('/', 'SettingController@index')->name('index');
        Route::put('/{setting}/update', 'SettingController@update')->name('update');
    });
//    Route::get('/setting', 'SettingController@index')->middleware('role:settings.index')->name('setting.index');

    //Sms
    Route::prefix('sms')->name('sms.')->group(function () {
        Route::get('/', 'SmsController@index')->middleware('role:sms.index')->name('index');
        Route::post('/send', 'SmsController@send')->middleware('role:sms.send')->name('send');
//        Route::get('/{sms}/show', 'SmsController@show')->middleware('role:sms.show')->name('show');
//        Route::put('/{sms}/update', 'SmsController@update')->middleware('role:sms.update')->name('update');
        Route::delete('/{sms}/destroy', 'SmsController@destroy')->middleware('role:sms.destroy')->name('destroy');
    });

//    Route::get('/sms', 'SmsController@index')->name('sms.index');



    //Lab
    Route::prefix('lab')->name('lab.')->group(function () {
        Route::get('/', 'LabController@index')->name('index');
        Route::post('/store', 'LabController@store')->name('store');
        Route::get('/{id}/show', 'LabController@show')->name('show');
        Route::put('/{id}/update', 'LabController@update')->name('update');
        Route::delete('/{id}/destroy', 'LabController@destroy')->name('destroy');
    });





    //  Test
    Route::namespace('Test')->prefix('test')->name('test.')->group(function () {

//        //Test To Patient
        Route::prefix('patient')->name('patient.')->group(function () {

            Route::get('/', 'PatientTestController@index')->name('index');
            Route::get('/create', 'PatientTestController@create')->name('create');
            Route::post('/store', 'PatientTestController@store')->name('store');
            Route::get('/{id}/show', 'PatientTestController@show')->name('show');
//            Route::get('/{id}/report', 'PatientTestController@report')->name('report');
            Route::get('/{id}/edit', 'PatientTestController@edit')->name('edit');
            Route::put('/{id}/update', 'PatientTestController@update')->name('update');
            Route::delete('/{id}/destroy', 'PatientTestController@destroy')->name('destroy');

            Route::get('/{id}/show-item', 'PatientTestController@itemBarcode')->name('show-item');
//            Route::get('/{id}/show-item', 'PatientTestController@showItem')->name('show-item');
            Route::post('/getPatient', 'PatientTestController@getPatient')->name('getPatient');
            Route::post('/getDoctor', 'PatientTestController@getDoctor')->name('getDoctor');
            Route::post('/getTest', 'PatientTestController@getTest')->name('getTest');
            Route::get('/{id}/pdf', 'PatientTestController@pdf')->name('pdf');
        });
//
        Route::prefix('category')->name('category.')->group(function () {
            Route::get('/', 'TestCategoryController@index')->name('index');
            Route::post('/store', 'TestCategoryController@store')->name('store');
            Route::get('/{id}/show', 'TestCategoryController@show')->name('show');
            Route::put('/{id}/update', 'TestCategoryController@update')->name('update');
            Route::delete('/{id}/destroy', 'TestCategoryController@destroy')->name('destroy');
        });

        Route::prefix('item')->name('item.')->group(function () {
            Route::get('/', 'TestItemController@index')->name('index');
            Route::post('/store', 'TestItemController@store')->name('store');
            Route::get('/{id}/show', 'TestItemController@show')->name('show');
            Route::put('/{id}/update', 'TestItemController@update')->name('update');
            Route::delete('/{id}/destroy', 'TestItemController@destroy')->name('destroy');
        });

        Route::prefix('result/category')->name('result.category.')->group(function () {
            Route::get('/', 'TestResultCategoryController@index')->name('index');
            Route::post('/store', 'TestResultCategoryController@store')->name('store');
            Route::get('/{id}/show', 'TestResultCategoryController@show')->name('show');
            Route::put('/{id}/update', 'TestResultCategoryController@update')->name('update');
            Route::delete('/{id}/destroy', 'TestResultCategoryController@destroy')->name('destroy');
        });

        Route::prefix('result/item')->name('result.item.')->group(function () {
            Route::get('/', 'TestResultItemController@index')->name('index');
            Route::post('/store', 'TestResultItemController@store')->name('store');
            Route::get('/{id}/show', 'TestResultItemController@show')->name('show');
            Route::put('/{id}/update', 'TestResultItemController@update')->name('update');
            Route::delete('/{id}/destroy', 'TestResultItemController@destroy')->name('destroy');
        });
    });

    //  Salary
    Route::namespace('Salary')->prefix('salary')->name('salary.')->group(function () {
//        //Total Salary
//        Route::prefix('total')->name('total.')->group(function () {
//            Route::get('/', 'TotalSalaryController@index')->name('index');
//            Route::post('/store', 'TotalSalaryController@store')->name('store');
//            Route::get('/{id}', 'TotalSalaryController@show')->name('show');
//            Route::put('/{id}/update', 'TotalSalaryController@update')->name('update');
//            Route::delete('/{id}/destroy', 'TotalSalaryController@destroy')->name('destroy');
//        });

        Route::get('/', 'SalaryController@index')->middleware('role:salary.index')->name('index');
        Route::post('/store', 'SalaryController@store')->middleware('role:salary.store')->name('store');
        Route::get('/{id}/show', 'SalaryController@show')->middleware('role:salary.show')->name('show');
        Route::put('/{id}/update', 'SalaryController@update')->middleware('role:salary.update')->name('update');
        Route::delete('/{id}/pay', 'SalaryController@pay')->middleware('role:salary.pay')->name('pay');
//        Route::delete('/{id}/destroy', 'SalaryController@destroy')->name('destroy');
        Route::get('/{id}/salarySheet', 'SalaryController@salarySheet')->middleware('role:salary.salarySheet')->name('salarySheet');
    });

    //  Bill
    Route::prefix('bill')->name('bill.')->group(function () {
        Route::get('/', 'BillController@index')->middleware('role:bill.index')->name('index');
        Route::get('/create', 'BillController@create')->middleware('role:bill.create')->name('create');
        Route::post('/store', 'BillController@store')->middleware('role:bill.store')->name('store');
        Route::get('/{id}/show', 'BillController@show')->middleware('role:bill.show')->name('show');
        Route::get('/{id}/edit', 'BillController@edit')->middleware('role:bill.edit')->name('edit');
        Route::put('/{bill}/update', 'BillController@update')->middleware('role:bill.update')->name('update');
        Route::delete('/{id}/destroy', 'BillController@destroy')->middleware('role:bill.destroy')->name('destroy');

        Route::get('/{id}/download', 'BillController@download')->name('download');
    });

    //  Account
    Route::prefix('account')->name('account.')->group(function () {
        Route::get('/', 'AccountController@index')->middleware('role:account.index')->name('index');
        Route::post('/store', 'AccountController@store')->middleware('role:account.store')->name('store');
        Route::get('/{id}/show', 'AccountController@show')->middleware('role:account.show')->name('show');
        Route::put('/{id}/update', 'AccountController@update')->middleware('role:account.update')->name('update');
        Route::delete('/{id}/destroy', 'AccountController@destroy')->middleware('role:account.destroy')->name('destroy');
    });

    //Daily Earning
    Route::prefix('earning')->name('earning.')->group(function () {
        Route::get('/', 'DailyEarningController@index')->name('index');
        Route::get('/create', 'DailyEarningController@create')->name('create');
        Route::post('/store', 'DailyEarningController@store')->name('store');
        Route::get('/{id}/show', 'DailyEarningController@show')->name('show');
        Route::get('/{id}/edit', 'DailyEarningController@edit')->name('edit');
        Route::put('/{id}/update', 'DailyEarningController@update')->name('update');
        Route::delete('/{id}/destroy', 'DailyEarningController@destroy')->name('destroy');
        Route::get('/{id}/pdf', 'DailyEarningController@pdf')->name('pdf');
        // Route::get('/{id}/download', 'DailyEarningController@download')->name('download');
    });

    //Email
//    Route::get('/email',function (){
//        $details=[
//            'title'=>'Mail From Innovative Software Limited',
//            'body'=>'This Is An Testing Mail From Innovative Software Limited',
//        ];
//        \Mail::to('prithyrajnag.prn@gmail.com')->send(new TestMail($details));
//        echo "Email has been sent";
//    });


});


//Company Auth

Route::get('/company/login', 'Company\CompanyController@showComLoginForm')->name('com-login');
Route::post('/company/login-validation', 'Company\CompanyController@loginValidation')->name('com-login-validation');
Route::post('/company/logout', 'Company\CompanyController@comLogout')->name('com-logout');



