<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class OrderFile extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    // This model only interacts with Media table; 

    
}
