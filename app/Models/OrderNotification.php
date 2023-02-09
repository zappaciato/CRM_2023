<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'order_id',
        'content',
    ];

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}
