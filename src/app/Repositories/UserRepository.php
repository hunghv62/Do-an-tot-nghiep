<?php

namespace App\Repositories;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;

class UserRepository
{
    public function getAll()
    {
        return User::all();
    }

    public function store($data)
    {
        return User::create($data);
    }

    public function findUserByName($key)
    {
        return User::where('name', 'like', '%' . $key . '%')
            ->where('id', '!=', auth()->id())->get();
    }
}
