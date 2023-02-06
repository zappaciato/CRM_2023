<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

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
        'user_id', 

        'date' ,
        'emailstatus',
    ];

    
}
