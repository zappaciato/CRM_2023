<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\CompanyAddress;
use App\Models\Contact;
use App\Models\Email;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(7)->create();
        // Company::factory(11)->create();
        // CompanyAddress::factory(11)->create();
        // Contact::factory(11)->create();
        // Email::factory(2)->create();
        // Order::factory(10)->create();
    }
}
