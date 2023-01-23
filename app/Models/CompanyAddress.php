<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAddress extends Model
{
    use HasFactory;

    protected $fillable = [
            'name', 
            'street',
            'city',
            'postal_code',
            'province',
            'country',
            'company_id', 
    ];


    public function companies()
    {
        return $this->belongsTo(Company::class);
    }
}
