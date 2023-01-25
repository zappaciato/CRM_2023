<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Log::info('I am creating a new user!');
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'role' => 'required',
            'phone' => 'required',
            'image' => 'nullable|image|max:1024',
            'password' => $this->passwordRules(),
        ])->validate();

        Log::info('I have validated a new user. Below is the data from the input:::  ');
        Log::debug($input);
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            // 'image' => $input['image'],
            'image' => 'test image',
            'role' => 'nieprzypisany',
            'password' => Hash::make($input['password']),
        ]);
    }
}
