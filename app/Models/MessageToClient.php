<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageToClient extends Model
{
    use HasFactory;

    protected $fillable = [


        'from',
        'to',
        'cc',
        'subject',
        'content',
        'order_id',
    ];


    public function orders()
    {
        return $this->belongsTo(Order::class);
    }

}
