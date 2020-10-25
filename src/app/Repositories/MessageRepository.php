<?php

namespace App\Repositories;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageRepository
{
    public function getAll()
    {
        return Message::all();
    }

    public function store($data)
    {
        return Message::create($data);
    }
}
