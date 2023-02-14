<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class MessageToClient extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [


        'from',
        'to',
        'cc',
        'subject',
        'content',
        'order_id',
        // 'msg-attachment'
    ];


    public function orders()
    {
        return $this->belongsTo(Order::class);
    }

}
