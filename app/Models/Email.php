<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Email extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'message_id', 
        'headers_raw', 
        'headers', 
        'from_name', 
        'from_address', 
        'subject', 
        'to', 
        'to_string', 
        'cc', 
        'bcc', 
        'text_plain',
        'text_html',
        'order_id',
        // 'notes', 

        'date' ,
        'emailstatus',
    ];

    
}
