<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class drug extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'quantity', 'image_path'];
    
    // Define relationships if any
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}