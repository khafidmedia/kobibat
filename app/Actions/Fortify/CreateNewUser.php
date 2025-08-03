<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'ttl' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'max:20'],
            'password' => $this->passwordRules(),
        ])->validate();


{

    dd($input); // ← tambahkan ini

    return User::create([
        'name' => $input['name'],
        'email' => $input['email'],
        'ttl' => $input['ttl'],
        'alamat' => $input['alamat'],
        'telepon' => $input['telepon'],
        'password' => Hash::make($input['password']),
    ]);
}


        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'ttl' => $input['ttl'],
            'alamat' => $input['alamat'],
            'telepon' => $input['telepon'],
            'password' => Hash::make($input['password']),
        ]);
    }
}