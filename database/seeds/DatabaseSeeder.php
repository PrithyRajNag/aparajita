<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*Independent*/
        $this->call(BloodGroupTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionTableSeeder::class);


        $this->call(DesignationTableSeeder::class);
        $this->call(CompanyEmployeeTableSeeder::class);


        $this->call(CompanyModuleTableSeeder::class);
//        $this->call(CompanyCreateorganizationTableSeeder::class);




        /*Dependent*/
        $this->call(UsersTableSeeder::class);



        $this->call(OrganizationTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);




        $this->call(AmbulanceTableSeeder::class);
        $this->call(NoticeTableSeeder::class);

        $this->call(BedTypeTableSeeder::class);
        $this->call(BedListTableSeeder::class);
        $this->call(BedAssignTableSeeder::class);

        $this->call(BirthTableSeeder::class);
        $this->call(DeathTableSeeder::class);

        $this->call(StaffHolidaysTableSeeder::class);


        $this->call(DoctorHolidaysTableSeeder::class);
        $this->call(AllDoctorsScheduleTableSeeder::class);

        $this->call(BloodInputTableSeeder::class);

        $this->call(PatientTableSeeder::class);
        $this->call(PatientAppointmentTableSeeder::class);


        $this->call(LabTableSeeder::class);
        $this->call(TestCategoriesTableSeeder::class);
        $this->call(TestItemsTableSeeder::class);
        $this->call(TestResultCategoryTableSeeder::class);
        $this->call(TestResultItemTableSeeder::class);
        $this->call(PatientTestReferredDoctorTableSeeder::class);



    }
}
