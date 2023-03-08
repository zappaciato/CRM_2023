<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileComment extends Model
{
    use HasFactory;


    protected $fillable = [
        'file_comment', 
        'media_id', 
        'order_id',
    ];

}
