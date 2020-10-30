<?php

namespace App\Repositories;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomRepository
{
    public function find($id)
    {
        Room::findOrFail($id);
    }
    public function getAll()
    {
        return Room::all();
    }

    public function store($data)
    {
        return Room::create($data);
    }

    public function findRoom($user_id, $friend_id)
    {
        return Room::where('user_created', $user_id)->where('user_join', $friend_id)->first();
    }
}
