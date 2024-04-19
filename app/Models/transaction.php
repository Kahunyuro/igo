<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['payment_gateway', 'amount', 'status', 'order_id'];
    
    // Define relationships
    public function order()
    {
        return $this->belongsTo(Orders::class);
    }
}