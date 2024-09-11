<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'total',
        'vat',
        'payable',
        'ship_details',
        'cust_details',
        'tran_id',
        'delivery_status',
        'payment_status',
        'user_id',
    ];
}
