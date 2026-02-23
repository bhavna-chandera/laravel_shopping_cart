<?php

namespace App;

namespace App\Enums;

enum OrderStatus: string
{
    case in_process = 'in_process';
    case dispatched = 'dispatched';
    case out_for_delivery = 'out_for_delivery';
    case delivered = 'delivered';
    case cancelled = 'cancelled';
}
