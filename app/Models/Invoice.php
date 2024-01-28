<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {
    protected $fillable = ['total', 'vat', 'payable', 'discount', 'ship_details', 'cust_details', 'shipping_method', 'tran_id', 'delivery_status', 'payment_status', 'user_id'];
}