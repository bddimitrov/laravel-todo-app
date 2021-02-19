<?php

namespace App\Repositories\User;

use App\Models\User;

/**
 * Class UserRepository
 * @package App\Repositories\User
 */
class UserRepository {

    /**
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        $user = User::create($data);
        return $user;
    }

    /**
     * @param $where
     * @return mixed
     */
    public function find($where)
    {
        return User::where($where)->get();
    }
}
