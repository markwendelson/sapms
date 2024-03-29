<?php

return [
    'item_code' => 'SPHV-'.date('Y-m-'),
    'pr_number' => 'PR-'.date('Y-m-'),
    'po_number' => 'PO-'.date('Y-m-'),
    'iar_number' => 'IAR-'.date('Y-m-'),
    'ris_number' => 'RIS-'.date('Y-m-'),

    'unit_of_measure' => [
        'unit',
        'box',
        'can',
        'pc',
    ],

    'category' => [
        'Common Electrical Supplies',
        'Common Computer Supplies/Consumables',
        'Common Office Equipment',
        'Electrical Equipment',
        'Common Office Supplies',
        'Office Office Devices',
        'Office Janitorial Supplies',
        'Cleaning Equipment and Supplies',
    ],

    'approval' => [
        'purchase_request' => 'SETUP P.R APPROVER NAME',
        'purchase_order' => 'SETUP P.O APPROVER NAME',
        'inspection_and_acceptance_1' => 'SETUP APPROVER NAME',
        'inspection_and_acceptance_2' => 'SETUP APPROVER NAME',
    ]
];
