<?php

namespace App\Repositories;

use App\Models\Friend;
use Illuminate\Http\Request;

class FriendRepository
{
    public function getAll()
    {
        return Friend::all();
    }

    public function store($data)
    {
        return Friend::create($data);
    }

    public function getFriends()
    {
        return Friend::where('status', Friend::ACCEPTED)
            ->orwhere('status', Friend::PENDING)
            ->where('user_created', auth()->id())->get();
    }

    public function getFriendRequest()
    {
        return Friend::where('user_created', auth()->id())
            ->where('status', Friend::PENDING)->get();
    }

    public function getFriendRequested()
    {
        return Friend::where('friend_id', auth()->id())
            ->where('status', Friend::PENDING)->get();
    }
}
