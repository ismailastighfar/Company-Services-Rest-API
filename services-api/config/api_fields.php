<?php

return [
    'api_keys' => [
        '3e5d69ea-078e-321f-a742-b7bd6921cb28' =>
              [
                  "fields" => [
                      'id','name', 'description',
                      'department_id',
                      'employee_id',
              ] ,
              "allowed_fields"  => [
                  'id','name', 'description',
                  'department_id','departments.id','departments.nameDep',
                  'employee_id','employees.id','employees.email'
              ] ,
        ],

        '8bc5b6fa-2fb9-3865-89a8-f14b65480097' => ['name','description', 'price'],
        'c14d64fb-49be-3ca4-8cf5-046c6e39eb97' => ['name','description','price', 'location'],
        'ce7d1adc-d90e-3cb1-b940-021a8594bf2d' => ['name','description','price', 'location','is_active', 'contact_email'],
        'f003a16b-ad5a-3e5b-afa0-45586cda29ba' => ['name','description','price', 'location','is_active', 'contact_email', 'contact_phone']
    ],
];
