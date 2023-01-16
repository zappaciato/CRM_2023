<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'created_by',
        'name',
        'phone',
        'country',
        'nip',
        'email',
        'www',
        'notes',
    ];

    // public function users()
    // {
    //     return $this->belogsTo(User::class, 'user_id', 'id');
    // }

    // public function orders()
    // {
    //     return $this->hasMany(Order::class, 'order_id', 'id');
    // }
}
