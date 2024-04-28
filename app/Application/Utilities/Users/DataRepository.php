<?php

namespace App\Application\Utilities\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class DataRepository
{

    /**
     * Create a new user.
     *
     * @param string $email The email address of the user.
     * @param array $data An associative array containing the user data.
     *                   
     * @return Model|User The newly created user model.
     */
    public function create(string $email , array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return User::firstOrCreate(['email' => $email], $data);
    }

    /**
     * Update user.
     *
     * @param Model $user The user model to update.
     * @param array $data An associative array containing the user data.
     *
     * @return bool The updated user model.
     */
    public function update(Model $user, array $data)
    {
        return $user->update($data);
    }
}
