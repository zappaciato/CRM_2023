<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;


    protected $table = 'companies';

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

    public function addresses() {
        return $this->hasMany(CompanyAddress::class);
    }

    public function contacts() {
        return $this->hasMany(Contact::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // public function contacts()
    // {
    //     return $this->hasMany(Contact::class, 'user_id', 'id');
    // }

    // public function orders()
    // {
    //     return $this->hasMany(Order::class, 'order_id', 'id');
    // }
}
