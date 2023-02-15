<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailsToOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'email_id',
        'user_id',
        'notes'
    ];
}
