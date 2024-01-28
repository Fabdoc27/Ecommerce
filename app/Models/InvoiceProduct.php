<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceProduct extends Model {
    protected $fillable = ['qty', 'sale_price', 'invoice_id', 'product_id', 'user_id'];

    public function products(): BelongsTo {
        return $this->belongsTo( Product::class, 'product_id' );
    }
}