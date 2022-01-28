<?php
/**
 * Created by PhpStorm.
 * User: Prithy Raj
 * Date: 4/21/2021
 * Time: 10:51 PM
 */

return [
    'ambulance' => [
        'index' => ['owner', 'admin', 'nurse', 'receptionist'],
        'store' => ['owner', 'admin', 'receptionist'],
        'show' => ['owner', 'admin', 'nurse', 'receptionist'],
        'update' => ['owner', 'admin', 'receptionist'],
        'destroy' => ['owner', 'admin'],
    ],


    'department' => [
        'index' => ['owner', 'admin', 'doctor'],
        'store' => ['owner', 'admin'],
        'show' => ['owner', 'admin', 'doctor'],
        'update' => ['owner', 'admin'],
        'destroy' => ['owner', 'admin'],
    ],


    'notice' => [
        'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist', 'other_staff'],
        'store' => ['owner', 'admin', 'receptionist'],
        'show' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist', 'other_staff'],
        'update' => ['owner', 'admin', 'receptionist'],
        'destroy' => ['owner', 'admin'],
    ],


    'healthCard' => [
        'index' => ['owner', 'admin', 'accountant', 'receptionist'],
        'store' => ['owner', 'admin', 'receptionist'],
        'show' => ['owner', 'admin', 'accountant', 'receptionist'],
        'update' => ['owner', 'admin', 'accountant', 'receptionist'],
        'destroy' => ['owner', 'admin'],
    ],


    'email' => [
        'index' => ['owner', 'admin', 'receptionist'],
        'send' => ['owner', 'admin', 'receptionist'],
//        'store' => ['owner', 'admin', 'receptionist'],
//        'show' => ['owner', 'admin', 'receptionist'],
//        'update' => ['owner', 'admin'],
        'destroy' => ['owner', 'admin'],
    ],


    'birth' => [
        'index' => ['owner', 'admin', 'receptionist'],
        'store' => ['owner', 'admin', 'receptionist'],
        'show' => ['owner', 'admin', 'receptionist'],
        'update' => ['owner', 'admin', 'receptionist'],
        'destroy' => ['owner', 'admin'],
    ],


    'death' => [
        'index' => ['owner', 'admin', 'receptionist'],
        'store' => ['owner', 'admin', 'receptionist'],
        'show' => ['owner', 'admin', 'receptionist'],
        'update' => ['owner', 'admin', 'receptionist'],
        'destroy' => ['owner', 'admin'],
    ],


    'sms' => [
        'index' => ['owner', 'admin', 'receptionist'],
        'send' => ['owner', 'admin', 'receptionist'],
//        'store' => ['owner', 'admin', 'receptionist'],
//        'show' => ['owner', 'admin', 'receptionist'],
//        'update' => ['owner', 'admin'],
        'destroy' => ['owner', 'admin'],
    ],


    'settings' => [
        'index' => ['owner'],
//        'store' => ['owner'],
//        'show' => ['owner'],
        'update' => ['owner'],
//        'destroy' => ['owner'],
    ],


    'profile' => [
        'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist', 'other_staff'],
        'update' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist', 'other_staff'],
        'passUpdate' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist', 'other_staff'],
    ],


    'patient' => [
        'appointment' => [
            'index' => ['owner', 'admin', 'doctor', 'accountant', 'receptionist'],
            'create' => ['owner', 'admin', 'doctor', 'receptionist'],
            'store' => ['owner', 'admin', 'doctor', 'receptionist'],
            'show' => ['owner', 'admin', 'doctor', 'accountant', 'receptionist'],
            'edit' => ['owner', 'admin', 'doctor', 'accountant', 'receptionist'],
            'update' => ['owner', 'admin', 'doctor', 'accountant', 'receptionist'],
            'destroy' => ['owner', 'admin', 'receptionist'],
        ],
        'payment' => [
            'index' => ['owner', 'admin', 'doctor', 'accountant', 'receptionist'],
            'create' => [],
            'show' => ['owner', 'admin', 'doctor', 'accountant', 'receptionist'],
            'update' => [],
            'destroy' => [],
            'pay' => ['owner', 'admin', 'accountant', 'receptionist'],
            'paid' => ['owner', 'admin', 'accountant'],
        ],

        'history' => [
            'appointments' => [
                'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
                'create' => ['owner', 'admin', 'doctor', 'receptionist'],
                'store' => ['owner', 'admin', 'doctor', 'receptionist'],
                'show' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
                'edit' => ['owner', 'admin', 'receptionist'],
                'update' => ['owner', 'admin', 'receptionist'],
                'destroy' => ['owner', 'admin'],
            ],
            'case' => [
                'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
                'create' => ['owner', 'admin', 'doctor', 'lab_staff', 'receptionist'],
                'store' => ['owner', 'admin', 'doctor', 'lab_staff', 'receptionist'],
                'show' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
                'edit' => ['owner', 'admin', 'doctor', 'lab_staff', 'receptionist'],
                'update' => ['owner', 'admin', 'doctor', 'lab_staff', 'receptionist'],
                'destroy' => ['owner', 'admin', 'doctor'],
            ],
            'lab' => [
                'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
                'report' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
                'show' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
                'edit' => ['owner', 'admin', 'lab_staff'],
                'download' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
                'destroy' => ['owner', 'admin', 'lab_staff'],
            ],
            'bed' => [
                'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
                'show' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
            ],
            'document' => [
                'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
                'upload' => ['owner', 'admin', 'doctor', 'accountant', 'receptionist'],
                'show' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
                'download' => ['owner', 'admin', 'doctor', 'accountant', 'lab_staff', 'receptionist'],
                'destroy' => ['owner', 'admin'],
            ],
            'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
            'store' => ['owner', 'admin', 'receptionist'],
            'show' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
            'update' => ['owner', 'admin', 'receptionist'],
            'destroy' => ['owner', 'admin'],
        ],

        'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist', 'other_staff'],
        'create' => ['owner', 'admin', 'receptionist'],
        'store' => ['owner', 'admin', 'receptionist'],
        'show' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist', 'other_staff'],
        'edit' => ['owner', 'admin', 'receptionist'],
        'update' => ['owner', 'admin', 'receptionist'],
        'destroy' => ['owner', 'admin'],
    ],


    'doctor' => [
        'allDoctorSchedule' => [
            'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist', 'other_staff'],
            'create' => ['owner', 'admin', 'doctor', 'receptionist'],
            'store' => ['owner', 'admin', 'doctor', 'receptionist'],
            'show' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist', 'other_staff'],
            'edit' => ['owner', 'admin', 'doctor', 'accountant', 'receptionist'],
            'update' => ['owner', 'admin', 'doctor', 'accountant', 'receptionist'],
            'destroy' => ['owner', 'admin', 'doctor'],
        ],
        'holidays' => [
            'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'receptionist'],
            'store' => ['owner', 'admin', 'doctor', 'receptionist'],
            'show' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'receptionist'],
            'update' => ['owner', 'admin', 'doctor', 'receptionist'],
            'destroy' => ['owner', 'admin', 'doctor'],
        ],

        'history' => [
            'appointment' => [
                'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
//                'create' => ['owner', 'admin', 'doctor', 'receptionist'],
//                'store' => ['owner', 'admin', 'doctor', 'receptionist'],
//                'show' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
//                'edit' => ['owner', 'admin', 'receptionist'],
//                'update' => ['owner', 'admin', 'receptionist'],
//                'destroy' => ['owner', 'admin'],
            ],
//            'schedule' => [
//                'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist', 'other_staff'],
//                'create' => ['owner', 'admin', 'doctor', 'receptionist'],
//                'store' => ['owner', 'admin', 'doctor', 'receptionist'],
//                'show' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist', 'other_staff'],
//                'edit' => ['owner', 'admin', 'doctor', 'accountant', 'receptionist'],
//                'update' => ['owner', 'admin', 'doctor', 'accountant', 'receptionist'],
//                'destroy' => ['owner', 'admin', 'doctor'],
//            ],
//            'holiday' => [
//                'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'receptionist'],
//                'create' => ['owner', 'admin', 'doctor', 'receptionist'],
//                'store' => ['owner', 'admin', 'doctor', 'receptionist'],
//                'show' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'receptionist'],
//                'edit' => ['owner', 'admin', 'doctor', 'receptionist'],
//                'update' => ['owner', 'admin', 'doctor', 'receptionist'],
//                'destroy' => ['owner', 'admin', 'doctor'],
//            ],
            'caseHistory' => [
                'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
//                'create' => ['owner', 'admin', 'doctor', 'lab_staff', 'receptionist'],
//                'store' => ['owner', 'admin', 'doctor', 'lab_staff', 'receptionist'],
//                'show' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
//                'edit' => ['owner', 'admin', 'doctor', 'lab_staff', 'receptionist'],
//                'update' => ['owner', 'admin', 'doctor', 'lab_staff', 'receptionist'],
//                'destroy' => ['owner', 'admin', 'doctor'],
            ],
            'labs' => [
                'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
                'report' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
                'show' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
//                'edit' => ['owner', 'admin', 'lab_staff'],
                'download' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
//                'destroy' => ['owner', 'admin', 'lab_staff'],
            ],
            'bed' => [
                'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
                'show' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
            ],
            'document' => [
                'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
                'upload' => ['owner', 'admin', 'doctor', 'accountant', 'receptionist'],
                'show' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
                'download' => ['owner', 'admin', 'doctor', 'accountant', 'lab_staff', 'receptionist'],
                'destroy' => ['owner', 'admin'],
            ],
            'index' => ['owner', 'admin', 'doctor', 'receptionist'],
            'store' => ['owner', 'admin', 'doctor', 'receptionist'],
            'show' => ['owner', 'admin', 'doctor', 'receptionist'],
            'update' => ['owner', 'admin', 'doctor', 'receptionist'],
            'destroy' => ['owner', 'admin'],
        ],

        'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
        'create' => ['owner', 'admin', 'accountant', 'receptionist'],
        'store' => ['owner', 'admin', 'accountant', 'receptionist'],
        'show' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'lab_staff', 'receptionist'],
        'edit' => ['owner', 'admin', 'receptionist'],
        'update' => ['owner', 'admin', 'receptionist'],
        'destroy' => ['owner', 'admin'],
    ],


    'staff' => [
        'holiday' => [
            'index' => ['owner', 'admin', 'nurse', 'accountant', 'lab_staff', 'receptionist', 'other_staff'],
            'store' => ['owner', 'admin', 'receptionist'],
            'show' => ['owner', 'admin', 'nurse', 'accountant', 'lab_staff', 'receptionist', 'other_staff'],
            'update' => ['owner', 'admin', 'receptionist'],
            'destroy' => ['owner', 'admin'],
        ],
        'index' => ['owner', 'admin', 'accountant'],
        'create' => ['owner', 'admin'],
        'store' => ['owner', 'admin'],
        'show' => ['owner', 'admin', 'accountant'],
        'edit' => ['owner', 'admin'],
        'update' => ['owner', 'admin'],
        'destroy' => ['owner', 'admin'],
    ],


    'bed' => [
        'assign' => [
            'index' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'receptionist'],
            'store' => ['owner', 'admin', 'receptionist'],
            'show' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'receptionist'],
            'update' => ['owner', 'admin', 'receptionist'],
            'destroy' => ['owner', 'admin'],
        ],
        'list' => [
            'index' => ['owner', 'admin', 'accountant', 'receptionist'],
            'store' => ['owner', 'admin', 'receptionist'],
            'show' => ['owner', 'admin', 'accountant', 'receptionist'],
            'update' => ['owner', 'admin'],
            'destroy' => ['owner', 'admin'],
        ],
        'type' => [
            'index' => ['owner', 'admin', 'nurse', 'accountant', 'receptionist'],
            'store' => ['owner', 'admin'],
            'show' => ['owner', 'admin', 'nurse', 'accountant', 'receptionist'],
            'update' => ['owner', 'admin'],
            'destroy' => ['owner', 'admin'],
        ],
    ],


    'blood' => [
        'input' => [
            'index' => ['owner', 'admin', 'doctor', 'accountant', 'lab_staff', 'receptionist'],
            'store' => ['owner', 'admin', 'lab_staff', 'receptionist'],
            'show' => ['owner', 'admin', 'doctor', 'accountant', 'lab_staff', 'receptionist'],
            'update' => ['owner', 'admin', 'lab_staff', 'receptionist'],
            'destroy' => ['owner', 'admin'],
        ],
        'output' => [
            'index' => ['owner', 'admin', 'lab_staff', 'receptionist'],
            'store' => ['owner', 'admin', 'lab_staff', 'receptionist'],
            'show' => ['owner', 'admin', 'lab_staff', 'receptionist'],
            'update' => ['owner', 'admin', 'lab_staff'],
            'destroy' => ['owner', 'admin'],
        ],
        'donor' => [
            'index' => ['owner', 'admin', 'receptionist'],
            'store' => ['owner', 'admin', 'receptionist'],
            'show' => ['owner', 'admin', 'receptionist'],
            'update' => ['owner', 'admin', 'receptionist'],
            'destroy' => ['owner', 'admin'],
        ],
    ],


//    'test' => [
//        'toPatient' => [
//            'index' => ['owner', 'admin', 'doctor', 'accountant', 'lab_staff', 'receptionist'],
//            'create' => ['owner', 'admin', 'accountant', 'receptionist'],
//            'store' => ['owner', 'admin', 'accountant', 'receptionist'],
//            'show' => ['owner', 'admin', 'doctor', 'accountant', 'lab_staff', 'receptionist'],
//            'edit' => ['owner', 'admin', 'accountant', 'receptionist'],
//            'update' => ['owner', 'admin', 'accountant', 'receptionist'],
//            'destroy' => ['owner', 'admin'],
//        ],
//        'index' => ['owner', 'admin', 'accountant', 'receptionist'],
//        'store' => ['owner', 'admin', 'accountant', 'receptionist'],
//        'show' => ['owner', 'admin', 'accountant', 'receptionist'],
//        'update' => ['owner', 'admin', 'accountant', 'receptionist'],
//        'destroy' => ['owner', 'admin'],
//    ],


    'salary' => [
//        'sheet' => [
//            'index' => ['owner', 'admin','doctor', 'accountant', 'lab_staff', 'receptionist'],
//            'store' => ['owner', 'admin', 'accountant', 'receptionist'],
//            'show' => ['owner', 'admin','doctor', 'accountant', 'lab_staff', 'receptionist'],
//            'update' => ['owner', 'admin', 'accountant', 'receptionist'],
//            'destroy' => ['owner', 'admin'],
//        ],
        'index' => ['owner', 'admin', 'accountant'],
        'store' => ['owner', 'admin', 'accountant'],
        'show' => ['owner', 'admin', 'accountant'],
        'update' => ['owner', 'admin', 'accountant'],
        'destroy' => ['owner', 'admin'],

        'pay' => ['owner', 'admin', 'accountant'],
        'salarySheet' => ['owner', 'admin', 'accountant'],
    ],


    'bill' => [
        'index' => ['owner', 'admin', 'accountant'],
        'create' => ['owner', 'admin', 'accountant'],
        'store' => ['owner', 'admin', 'accountant'],
        'edit' => ['owner', 'admin', 'accountant'],
        'show' => ['owner', 'admin', 'accountant'],
        'update' => ['owner', 'admin', 'accountant'],
        'destroy' => ['owner', 'admin'],
    ],


    'account' => [
        'index' => ['owner', 'admin', 'accountant'],
        'store' => ['owner', 'admin', 'accountant'],
        'show' => ['owner', 'admin', 'accountant'],
        'update' => ['owner', 'admin', 'accountant'],
        'destroy' => ['owner', 'admin'],
    ],


    'sidenav' => [
        'staff' => ['owner', 'admin', 'nurse', 'accountant', 'lab_staff', 'receptionist', 'other_staff'],
        'bed' => ['owner', 'admin', 'doctor', 'nurse', 'accountant', 'receptionist'],
        'accounts' => ['owner', 'admin', 'doctor', 'accountant', 'receptionist'],
//        'test' => ['owner', 'admin', 'doctor', 'accountant', 'lab_staff', 'receptionist'],
        'blood' => ['owner', 'admin', 'doctor', 'accountant', 'lab_staff', 'receptionist'],
        'activity' => ['owner', 'admin', 'receptionist'],
        'settings' => ['owner'],
    ],


    'action' => [
        'ambulance' => ['owner', 'admin', 'receptionist'],
        'bed' => [
            'assign' => ['owner', 'admin', 'receptionist'],
            'list' => ['owner', 'admin'],
            'type' => ['owner', 'admin'],
        ],
        'bill' => ['owner', 'admin', 'accountant'],
        'birth' => ['owner', 'admin', 'receptionist'],
        'blood' => [
            'input' => ['owner', 'admin', 'lab_staff', 'receptionist'],
            'output' => ['owner', 'admin', 'lab_staff'],
            'donor' => ['owner', 'admin', 'receptionist'],
        ],
        'death' => ['owner', 'admin', 'receptionist'],
        'department' => ['owner', 'admin'],
        'doctor' => [
            'allDoctorSchedule' => ['owner', 'admin', 'doctor', 'accountant', 'receptionist'],
            'holidays' => ['owner', 'admin', 'doctor', 'receptionist'],
            'index' => ['owner', 'admin', 'receptionist'],
        ],
        'healthCard' => ['owner', 'admin', 'accountant', 'receptionist'],
        'notice' => ['owner', 'admin', 'receptionist'],
        'patient' => [
            'appointment' => ['owner', 'admin', 'doctor', 'accountant', 'receptionist'],
            'payment' => ['owner', 'admin', 'accountant', 'receptionist'],
            'index' => ['owner', 'admin', 'receptionist'],
        ],
        'staff' => [
            'holiday' => ['owner', 'admin', 'receptionist'],
            'index' => ['owner', 'admin'],
        ],
        'test' => [
            'toPatient' => ['owner', 'admin'],
            'index' => ['owner', 'admin', 'accountant', 'receptionist'],
        ],
    ],
];
