<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
            'name',
            'surname',
            'position', 
            'email',
            'phone',
            'phone_business',
            'notes',
            'company_id',
    ];


    public function companies()
    {
        return $this->belongsTo(Company::class);
    }
}
