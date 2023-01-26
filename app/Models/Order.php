<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'email_id',
        'contact_person',
        'address',
        'lead_person',
        'involved_person',
        'priority',
        'order_content',
        'order_notes',

        'date',
        'status',
        'company_id',


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
