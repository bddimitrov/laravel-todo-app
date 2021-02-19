<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository {

    public function store($data)
    {
        $user = User::create($data);
        return $user;
    }

    public function find($where)
    {
        return User::where($where)->get();
    }
}
