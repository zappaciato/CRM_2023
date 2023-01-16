<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'title',
        'status',
        'date',


        // 'companyName',
        // 'created_by',
        // 'status',
        // 'contactPerson',
        // 'leadPerson',
        // 'orderType',
        // 'priority',
        // 'deadline',
        // 'orderTitle',
        // 'orderContent',
        // 'notes',
    ];
}
