<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company_id',
        'email_id',
        'contact_person',
        'address',
        'lead_person',
        'involved_person',
        'priority',
        'order_content',
        'order_notes',

        'deadline',
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

    public function companies() {

        return $this->belongsTo(Company::class);
    }

    // public function users() {

    //     return $this->hasMany(User::class);
    // }

    
}
