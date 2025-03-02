<?php

namespace App\Helpers;

class Constant
{

    const USER_TYPE = [
        'ADMIN' => 1,
        'STAFF' => 2,
        'CUSTOMER' => 3
    ];
    
    const ORDER = [
        'SUBMITTED' => 1,
        'PLACED' => 2,
        'PROCESSING' => 3,
        'FOR_DELIVERY' => 4,
        'DELIVERED' => 5,
        'COMPLETED' => 6,
        'CANCELLED' => 7,
        'DELIVERY_CHANGED' => 8
    ];
    
    const MONTH = [
        'JANUARY' => 1,
        'FEBRUARY' => 2,
        'MARCH' => 3,
        'APRIL' => 4,
        'MAY' => 5,
        'JUNE' => 6,
        'JULY' => 7,
        'AUGUST' => 8,
        'SEPTEMBER' => 9,
        'OCTOBER' => 10,
        'NOVEMBER' => 11,
        'DECEMBER' => 12,
    ];


    const CANCELLED_STATUS = [
        'MANUAL_UPDATE' => 0,
        'PENDING' => 1,
        'APPROVED' => 2,
        'REJECTED' => 4
    ];
}