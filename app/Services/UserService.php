<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserService
{

    public function getAllUsers()
    {
        return User::all();
    }
    public function createUser($data)
    {

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        return User::create($data);
    }
    public function getUserById($id)
    {
        return User::findOrFail($id);
    }
    public function updateUser($data, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        $user->update($data);
        return $user;
    }
    public function deleteUser($id)
    {
        return User::findOrFail($id)->delete();
    }
}
